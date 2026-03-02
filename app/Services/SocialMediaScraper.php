<?php

namespace App\Services;

use App\Enums\Platform;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SocialMediaScraper
{
    /**
     * Main entry point: try multiple scraping strategies.
     *
     * @return array{title: ?string, image: ?string}
     */
    public function scrape(string $url): array
    {
        $platform = Platform::detectFromUrl($url);

        // Strategy 1: Platform-specific oEmbed
        $result = match ($platform) {
            Platform::Instagram => $this->scrapeInstagramOEmbed($url),
            Platform::TikTok => $this->scrapeTikTokOEmbed($url),
            Platform::YouTube => $this->scrapeYouTubeOEmbed($url),
            Platform::Twitter => $this->scrapeTwitterOEmbed($url),
            default => null,
        };

        if ($result && ($result['title'] || $result['image'])) {
            return $result;
        }

        // Strategy 2: Open Graph meta tags
        $result = $this->scrapeOpenGraph($url);

        if ($result && ($result['title'] || $result['image'])) {
            return $result;
        }

        // Strategy 3: Fallback — return empty
        return ['title' => null, 'image' => null];
    }

    /**
     * Instagram oEmbed API (requires Facebook App Token for full access,
     * but basic endpoint works for public posts).
     */
    protected function scrapeInstagramOEmbed(string $url): ?array
    {
        try {
            $response = Http::timeout(10)->get('https://graph.facebook.com/v18.0/instagram_oembed', [
                'url' => $url,
                'access_token' => config('services.instagram.token', ''),
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'title' => $data['title'] ?? null,
                    'image' => $data['thumbnail_url'] ?? null,
                ];
            }
        } catch (\Throwable $e) {
            Log::warning("Instagram oEmbed failed: {$e->getMessage()}");
        }

        return null;
    }

    /**
     * TikTok oEmbed API (public, no auth required).
     */
    protected function scrapeTikTokOEmbed(string $url): ?array
    {
        try {
            $response = Http::timeout(10)->get('https://www.tiktok.com/oembed', [
                'url' => $url,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'title' => $data['title'] ?? null,
                    'image' => $data['thumbnail_url'] ?? null,
                ];
            }
        } catch (\Throwable $e) {
            Log::warning("TikTok oEmbed failed: {$e->getMessage()}");
        }

        return null;
    }

    /**
     * YouTube oEmbed API.
     */
    protected function scrapeYouTubeOEmbed(string $url): ?array
    {
        try {
            $response = Http::timeout(10)->get('https://www.youtube.com/oembed', [
                'url' => $url,
                'format' => 'json',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'title' => $data['title'] ?? null,
                    'image' => $data['thumbnail_url'] ?? null,
                ];
            }
        } catch (\Throwable $e) {
            Log::warning("YouTube oEmbed failed: {$e->getMessage()}");
        }

        return null;
    }

    /**
     * Twitter/X oEmbed API.
     */
    protected function scrapeTwitterOEmbed(string $url): ?array
    {
        try {
            $response = Http::timeout(10)->get('https://publish.twitter.com/oembed', [
                'url' => $url,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                // Twitter oEmbed doesn't return images in the standard way;
                // we extract from the HTML if possible
                $html = $data['html'] ?? '';
                preg_match('/src="([^"]+)"/', $html, $matches);

                return [
                    'title' => $data['author_name'] ?? null,
                    'image' => $matches[1] ?? null,
                ];
            }
        } catch (\Throwable $e) {
            Log::warning("Twitter oEmbed failed: {$e->getMessage()}");
        }

        return null;
    }

    /**
     * Generic Open Graph meta-tag scraper.
     */
    protected function scrapeOpenGraph(string $url): ?array
    {
        try {
            $response = Http::timeout(10)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (compatible; DailyHAM/1.0)',
                ])
                ->get($url);

            if (! $response->successful()) {
                return null;
            }

            $html = $response->body();

            $title = $this->extractMetaContent($html, 'og:title')
                ?? $this->extractMetaContent($html, 'og:description')
                ?? $this->extractTitle($html);

            $image = $this->extractMetaContent($html, 'og:image');

            return ['title' => $title, 'image' => $image];
        } catch (\Throwable $e) {
            Log::warning("Open Graph scraping failed for {$url}: {$e->getMessage()}");
        }

        return null;
    }

    /**
     * Extract content from an OG meta tag.
     */
    protected function extractMetaContent(string $html, string $property): ?string
    {
        $pattern = '/<meta\s+(?:property|name)=["\']' . preg_quote($property, '/') . '["\']\s+content=["\']([^"\']+)["\']/i';

        if (preg_match($pattern, $html, $matches)) {
            return html_entity_decode($matches[1], ENT_QUOTES, 'UTF-8');
        }

        // Try reversed attribute order
        $pattern = '/<meta\s+content=["\']([^"\']+)["\']\s+(?:property|name)=["\']' . preg_quote($property, '/') . '["\']/i';

        if (preg_match($pattern, $html, $matches)) {
            return html_entity_decode($matches[1], ENT_QUOTES, 'UTF-8');
        }

        return null;
    }

    /**
     * Extract <title> tag content as fallback.
     */
    protected function extractTitle(string $html): ?string
    {
        if (preg_match('/<title[^>]*>([^<]+)<\/title>/i', $html, $matches)) {
            return trim(html_entity_decode($matches[1], ENT_QUOTES, 'UTF-8'));
        }

        return null;
    }
}
