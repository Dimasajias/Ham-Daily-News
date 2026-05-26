<?php

namespace App\Jobs;

use App\Enums\ActivityStatus;
use App\Enums\Platform;
use App\Models\Activity;
use App\Services\SocialMediaScraper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ScrapeActivityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 30;

    public function __construct(
        public Activity $activity
    ) {}

    public function handle(SocialMediaScraper $scraper): void
    {
        $links = $this->activity->social_media_links ?? [];

        if (empty($links)) {
            Log::info("No links to scrape for activity #{$this->activity->id}");
            $this->activity->update(['status' => ActivityStatus::Pending]);
            return;
        }

        Log::info("Scraping activity #{$this->activity->id}: " . count($links) . " links");

        // Coba scrape dari link pertama yang berhasil
        $data = ['title' => null, 'image' => null];

        foreach ($links as $link) {
            $url = $link['url'] ?? null;
            if (!$url) continue;

            $result = $scraper->scrape($url);

            if ($result['title'] || $result['image']) {
                $data = $result;
                Log::info("Scrape success from: {$url}", $result);
                break;
            }
        }

        // Update activity
        $this->activity->update([
            'extracted_title' => $data['title'] ?: $this->activity->extracted_title,
            'extracted_image' => $data['image'],
            'status'          => ActivityStatus::Pending,
        ]);

        Log::info("Scraping complete for activity #{$this->activity->id}", $data);
    }

    public function failed(\Throwable $exception): void
    {
        Log::error("Scraping failed for activity #{$this->activity->id}: {$exception->getMessage()}");

        // Still move to pending so admin can manually fill in details
        $this->activity->update([
            'status' => ActivityStatus::Pending,
        ]);
    }
}
