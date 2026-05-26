<?php

namespace App\Http\Controllers;

use App\Enums\Platform;
use App\Models\Activity;
use App\Models\Hoax;
use App\Models\Office;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::published()->with(['office', 'user'])->applyFilters($request);

        $activities = $query->latest('approved_at')->paginate(12)->appends($request->query());

        $offices = Office::orderByRaw("CASE WHEN name LIKE 'Kementerian%' THEN 0 ELSE 1 END")
            ->orderBy('name')
            ->get();
        return view('welcome', compact('activities', 'offices'));
    }

    public function kegiatan(Request $request)
    {
        $query = Activity::published()->with(['office', 'user'])->applyFilters($request);

        $activities = $query->latest('approved_at')->paginate(15)->appends($request->query());
        $offices = Office::orderByRaw("CASE WHEN name LIKE 'Kementerian%' THEN 0 ELSE 1 END")
            ->orderBy('name')
            ->get();

        // Data untuk Grafik Platform — hitung dari JSON array
        $platformData = collect();
        Activity::published()
            ->applyFilters($request)
            ->select('social_media_links')
            ->get()
            ->each(function ($activity) use (&$platformData) {
                $links = $activity->social_media_links ?? [];
                foreach ($links as $link) {
                    $platform = $link['platform'] ?? 'other';
                    $platformData[$platform] = ($platformData[$platform] ?? 0) + 1;
                }
            });

        // ── Tentukan rentang waktu untuk grafik trend ──
        $filterDari   = $request->filled('dari')   ? \Carbon\Carbon::parse($request->dari)->startOfDay()   : now()->subDays(6)->startOfDay();
        $filterSampai = $request->filled('sampai') ? \Carbon\Carbon::parse($request->sampai)->endOfDay()   : now()->endOfDay();

        // ── Tentukan format label (hari atau bulan) ──
        $diffDays = (int) $filterDari->diffInDays($filterSampai);
        $groupByMonth = $diffDays > 31; // Jika rentang > 31 hari, kelompokkan per bulan

        // Ambil semua data mentah (platform + tanggal)
        $rawActivities = Activity::published()
            ->applyFilters($request)
            ->whereBetween('approved_at', [$filterDari, $filterSampai])
            ->select('social_media_links', 'approved_at')
            ->get();

        // Buat label sumbu X
        $trendLabels = [];
        if ($groupByMonth) {
            // Per bulan
            $current = $filterDari->copy()->startOfMonth();
            while ($current->lte($filterSampai)) {
                $trendLabels[] = $current->translatedFormat('M Y');
                $current->addMonth();
            }
        } else {
            // Per hari
            for ($i = $diffDays; $i >= 0; $i--) {
                $trendLabels[] = $filterSampai->copy()->subDays($i)->translatedFormat('d M');
            }
        }

        // Platform yang didukung
        $platforms = ['instagram', 'youtube', 'tiktok', 'twitter', 'facebook'];
        $platformColors = [
            'instagram' => '#E1306C',
            'youtube'   => '#CC0000',
            'tiktok'    => '#111111',
            'twitter'   => '#6B7280',
            'facebook'  => '#1877F2',
        ];
        $platformLabelsMap = [
            'instagram' => 'Instagram',
            'youtube'   => 'YouTube',
            'tiktok'    => 'TikTok',
            'twitter'   => 'X / Twitter',
            'facebook'  => 'Facebook',
        ];

        // Hitung data per platform per label
        $trendByPlatform = [];
        foreach ($platforms as $platform) {
            $trendByPlatform[$platform] = array_fill(0, count($trendLabels), 0);
        }

        foreach ($rawActivities as $activity) {
            $links = $activity->social_media_links ?? [];
            foreach ($links as $link) {
                $p = $link['platform'] ?? null;
                if (!$p || !in_array($p, $platforms)) continue;

                if ($groupByMonth) {
                    $labelKey = $activity->approved_at->translatedFormat('M Y');
                } else {
                    $labelKey = $activity->approved_at->translatedFormat('d M');
                }
                $idx = array_search($labelKey, $trendLabels);
                if ($idx !== false) {
                    $trendByPlatform[$p][$idx]++;
                }
            }
        }

        // Hapus platform yang semua nilainya 0
        $trendDatasets = [];
        foreach ($platforms as $p) {
            if (array_sum($trendByPlatform[$p]) > 0) {
                $trendDatasets[] = [
                    'label'           => $platformLabelsMap[$p],
                    'data'            => $trendByPlatform[$p],
                    'backgroundColor' => $platformColors[$p],
                    'borderRadius'    => 4,
                    'borderSkipped'   => false,
                ];
            }
        }

        return view('kegiatan', compact('activities', 'offices', 'platformData', 'trendLabels', 'trendDatasets'));
    }

    public function export(Request $request)
    {
        $query = Activity::published()->with(['office', 'user'])->applyFilters($request);
        $activities = $query->latest('approved_at')->get();

        $fileName = 'rekap_kegiatan_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Unit Kerja', 'Judul Kegiatan', 'Platform', 'Tanggal Publikasi', 'Link Media Sosial'];

        $callback = function() use($activities, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($activities as $activity) {
                // Gabungkan semua platform
                $platforms = collect($activity->social_media_links ?? [])
                    ->pluck('platform')
                    ->map(fn ($p) => Platform::tryFrom($p)?->label() ?? $p)
                    ->join(', ');

                // Gabungkan semua URL
                $urls = collect($activity->social_media_links ?? [])
                    ->pluck('url')
                    ->join(' | ');

                fputcsv($file, [
                    $activity->office?->name ?? '-',
                    $activity->extracted_title,
                    $platforms ?: '-',
                    $activity->approved_at?->translatedFormat('d M Y, H:i') ?? '-',
                    $urls ?: '-',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function show(Activity $activity)
    {
        abort_unless($activity->status->value === 'approved', 404);
        $activity->load(['office', 'user']);

        return view('activity-show', compact('activity'));
    }
    public function offices()
    {
        $offices = Office::withCount([
            'activities as published_count' => function ($q) {
                $q->where('status', 'approved');
            },
            'activities as today_count' => function ($q) {
                $q->where('status', 'approved')->whereDate('approved_at', today());
            },
        ])
        ->orderByRaw("CASE WHEN name LIKE 'Kementerian%' THEN 0 ELSE 1 END")
        ->orderBy('name')
        ->get();

        $totalActivities = Activity::published()->count();
        $totalToday = Activity::published()->whereDate('approved_at', today())->count();

        return view('offices', compact('offices', 'totalActivities', 'totalToday'));
    }

    public function hoax(Request $request)
    {
        $query = Hoax::published()->with('user');

        if ($request->filled('cari')) {
            $query->where('title', 'like', '%' . $request->cari . '%');
        }

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('published_at', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('published_at', '<=', $request->tanggal_akhir);
        }

        $hoaxes = $query->latest('published_at')->paginate(12)->appends($request->query());
        $totalHoaxes = Hoax::published()->count();

        return view('hoax', compact('hoaxes', 'totalHoaxes'));
    }

    public function showHoax(Hoax $hoax)
    {
        abort_unless($hoax->is_published, 404);

        $related = Hoax::published()
            ->where('id', '!=', $hoax->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('hoax-show', compact('hoax', 'related'));
    }
}
