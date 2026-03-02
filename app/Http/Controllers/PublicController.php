<?php

namespace App\Http\Controllers;

use App\Enums\Unit;
use App\Models\Activity;
use App\Models\Office;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::published()->with(['office', 'user']);

        // Filter by kanwil
        if ($request->filled('kanwil')) {
            $query->where('office_id', $request->kanwil);
        }

        // Filter by unit
        if ($request->filled('unit')) {
            $query->where('unit', $request->unit);
        }

        // Filter by date range
        if ($request->filled('dari')) {
            $query->whereDate('approved_at', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->whereDate('approved_at', '<=', $request->sampai);
        }

        // Search by title
        if ($request->filled('cari')) {
            $query->where('extracted_title', 'like', '%' . $request->cari . '%');
        }

        // Filter today
        if ($request->filled('hari_ini')) {
            $query->whereDate('created_at', today());
        }

        $activities = $query->latest('approved_at')->paginate(12)->appends($request->query());

        $offices = Office::orderBy('name')->get();
        $units = Unit::cases();

        return view('welcome', compact('activities', 'offices', 'units'));
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
}
