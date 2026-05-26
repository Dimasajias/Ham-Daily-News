<?php

namespace App\Services;

use App\Enums\Platform;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SocialMediaScraper
{
    /**
     * Whitelist domain yang diizinkan untuk scraping.
     * Hanya URL dari domain ini yang akan diproses.
     */
    protected const ALLOWED_DOMAINS = [
        // Instagram
        'instagram.com', 'www.instagram.com',
        // TikTok
        'tiktok.com', 'www.tiktok.com', 'vm.tiktok.com',
        // YouTube
        'youtube.com', 'www.youtube.com', 'youtu.be', 'm.youtube.com',
        // Twitter/X
        'twitter.com', 'www.twitter.com', 'x.com', 'www.x.com',
        // Facebook
        'facebook.com', 'www.facebook.com', 'fb.com', 'fb.watch',
        'm.facebook.com', 'web.facebook.com',
    ];

    /**
     * Main entry point: validasi URL lalu scraping.
     *
     * @return array{title: ?string, image: ?string}
     */
    public function scrape(string $url): array
    {
        // ──── SSRF Protection: Validasi URL ────
        if (!$this->isUrlSafe($url)) {
            Log::warning("SSRF BLOCKED: URL ditolak", ['url' => $url]);
            return ['title' => null, 'image' => null];
        }

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
     * ──── SSRF Protection ────
     * Validasi URL untuk mencegah Server-Side Request Forgery:
     * 1. Harus URL valid dengan scheme http/https
     * 2. Domain harus ada di whitelist
     * 3. IP address harus bukan private/internal
     */
    protected function isUrlSafe(string $url): bool
    {
        // 1. Parse URL
        $parsed = parse_url($url);
        if (!$parsed || !isset($parsed['scheme'], $parsed['host'])) {
            return false;
        }

        // 2. Hanya izinkan http dan https
        if (!in_array(strtolower($parsed['scheme']), ['http', 'https'], true)) {
            return false;
        }

        $host = strtolower($parsed['host']);

        // 3. Cek whitelist domain
        $isAllowed = false;
        foreach (self::ALLOWED_DOMAINS as $domain) {
            if ($host === $domain || str_ends_with($host, '.' . $domain)) {
                $isAllowed = true;
                break;
            }
        }

        if (!$isAllowed) {
            Log::warning("SSRF: Domain tidak diizinkan", ['host' => $host, 'url' => $url]);
            return false;
        }

        // 4. Resolve DNS dan blokir private/reserved IP
        $ips = gethostbynamel($host);
        if ($ips === false) {
            return false;
        }

        foreach ($ips as $ip) {
            if ($this->isPrivateIp($ip)) {
                Log::warning("SSRF: Private IP terdeteksi", ['host' => $host, 'ip' => $ip]);
                return false;
            }
        }

        return true;
    }

    /**
     * Cek apakah IP address termasuk private/reserved range.
     * Mencegah akses ke jaringan internal (127.0.0.1, 10.x.x.x, 192.168.x.x, dll).
     */
    protected function isPrivateIp(string $ip): bool
    {
        return filter_var(
            $ip,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        ) === false;
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
