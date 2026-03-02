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
        Log::info("Scraping activity #{$this->activity->id}: {$this->activity->social_media_url}");

        // Detect platform
        $platform = Platform::detectFromUrl($this->activity->social_media_url);

        // Scrape metadata
        $data = $scraper->scrape($this->activity->social_media_url);

        // Update the activity
        $this->activity->update([
            'platform' => $platform,
            'extracted_title' => $data['title'],
            'extracted_image' => $data['image'],
            'status' => ActivityStatus::Pending,
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
