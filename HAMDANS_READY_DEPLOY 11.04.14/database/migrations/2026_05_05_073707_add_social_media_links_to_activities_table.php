<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->json('social_media_links')->nullable()->after('description');
        });

        // Migrasi data lama: pindahkan social_media_url + platform ke JSON
        DB::table('activities')
            ->whereNotNull('social_media_url')
            ->orderBy('id')
            ->each(function ($activity) {
                $links = [
                    [
                        'platform' => $activity->platform ?? 'other',
                        'url'      => $activity->social_media_url,
                    ],
                ];
                DB::table('activities')
                    ->where('id', $activity->id)
                    ->update(['social_media_links' => json_encode($links)]);
            });

        // Hapus kolom lama
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn(['social_media_url', 'platform']);
        });
    }

    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->string('social_media_url')->nullable()->after('description');
            $table->string('platform')->nullable()->after('social_media_url');
        });

        // Restore data dari JSON ke kolom lama
        DB::table('activities')
            ->whereNotNull('social_media_links')
            ->orderBy('id')
            ->each(function ($activity) {
                $links = json_decode($activity->social_media_links, true);
                if (!empty($links[0])) {
                    DB::table('activities')
                        ->where('id', $activity->id)
                        ->update([
                            'social_media_url' => $links[0]['url'] ?? null,
                            'platform'         => $links[0]['platform'] ?? null,
                        ]);
                }
            });

        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('social_media_links');
        });
    }
};
