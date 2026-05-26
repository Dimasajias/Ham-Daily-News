<?php

namespace App\Enums;

enum Platform: string
{
    case Instagram = 'instagram';
    case TikTok = 'tiktok';
    case Twitter = 'twitter';
    case Facebook = 'facebook';
    case YouTube = 'youtube';
    case Other = 'other';

    public function label(): string
    {
        return match ($this) {
            self::Instagram => 'Instagram',
            self::TikTok => 'TikTok',
            self::Twitter => 'Twitter / X',
            self::Facebook => 'Facebook',
            self::YouTube => 'YouTube',
            self::Other => 'Other',
        };
    }

    public function icon(): string
    {
        return '';
    }

    public static function detectFromUrl(string $url): self
    {
        $host = parse_url($url, PHP_URL_HOST) ?? '';
        $host = strtolower($host);

        return match (true) {
            str_contains($host, 'instagram.com') => self::Instagram,
            str_contains($host, 'tiktok.com') => self::TikTok,
            str_contains($host, 'twitter.com'), str_contains($host, 'x.com') => self::Twitter,
            str_contains($host, 'facebook.com'), str_contains($host, 'fb.com') => self::Facebook,
            str_contains($host, 'youtube.com'), str_contains($host, 'youtu.be') => self::YouTube,
            default => self::Other,
        };
    }
}
