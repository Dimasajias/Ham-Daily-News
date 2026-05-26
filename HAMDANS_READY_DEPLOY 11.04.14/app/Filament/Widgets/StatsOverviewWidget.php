<?php

namespace App\Filament\Widgets;

use App\Models\Activity;
use App\Models\Office;
use App\Enums\ActivityStatus;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 0;

    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $user = auth()->user();
        $isRegional = $user && $user->hasRole('regional');

        // Scope queries to user's office for regional staff
        $baseQuery = Activity::query();
        if ($isRegional) {
            $baseQuery->where('user_id', $user->id);
        }

        $totalActivities = (clone $baseQuery)->count();
        $pending = (clone $baseQuery)->where('status', ActivityStatus::Pending)->count();
        $published = (clone $baseQuery)->where('status', ActivityStatus::Approved)->count();
        $todayCount = (clone $baseQuery)->where('status', ActivityStatus::Approved)
            ->whereDate('approved_at', today())
            ->count();

        $scopeLabel = $isRegional ? ('Kegiatan ' . ($user->office?->name ?? 'Anda')) : 'Semua kegiatan terdaftar';

        return [
            Stat::make('Total Kegiatan', $totalActivities)
                ->description($scopeLabel)
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, $totalActivities]),

            Stat::make('Menunggu Persetujuan', $pending)
                ->description('Butuh review admin')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                ->chart([2, 4, 1, 3, $pending, $pending]),

            Stat::make('Publikasi Aktif', $published)
                ->description('Tampil di halaman depan')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success')
                ->chart([3, 5, 7, 8, 10, $published]),

            Stat::make('Hari Ini', $todayCount)
                ->description('Dipublikasikan hari ini')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info')
                ->chart([0, 1, 2, 1, 0, $todayCount]),
        ];
    }
}
