<?php

namespace App\Http\Controllers;

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

        $offices = Office::orderBy('name')->get();
        return view('welcome', compact('activities', 'offices'));
    }

    public function kegiatan(Request $request)
    {
        $query = Activity::published()->with(['office', 'user'])->applyFilters($request);

        $activities = $query->latest('approved_at')->paginate(15)->appends($request->query());
        $offices = Office::orderBy('name')->get();

        // Data untuk Grafik Platform
        $platformData = Activity::published()
            ->applyFilters($request)
            ->selectRaw('platform, count(*) as total')
            ->groupBy('platform')
            ->pluck('total', 'platform');

        // Data untuk Grafik Trend (7 Hari Terakhir)
        $trendData = Activity::published()
            ->applyFilters($request)
            ->where('approved_at', '>=', now()->subDays(6)->startOfDay())
            ->selectRaw('DATE(approved_at) as date, count(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date');

        // Mengisi tanggal kosong pada trend data
        $trendLabels = [];
        $trendValues = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $trendLabels[] = now()->subDays($i)->translatedFormat('d M');
            $trendValues[] = $trendData->get($date, 0);
        }

        return view('kegiatan', compact('activities', 'offices', 'platformData', 'trendLabels', 'trendValues'));
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
                fputcsv($file, [
                    $activity->office?->name ?? '-',
                    $activity->extracted_title,
                    $activity->platform?->value ?? '-',
                    $activity->approved_at?->translatedFormat('d M Y, H:i') ?? '-',
                    $activity->social_media_url,
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

