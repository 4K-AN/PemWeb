<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicEvent;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AkademikController extends Controller
{
    /**
     * Menampilkan halaman kalender akademik
     */
    public function index(Request $request)
    {
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        $events = AcademicEvent::whereYear('event_date', $year)
                              ->whereMonth('event_date', $month)
                              ->get();

        return view('akademik.Kalender.index', compact('year', 'month', 'events'));
    }

    /**
     * Menampilkan detail event pada tanggal tertentu
     */
    public function detail(Request $request, $day)
    {
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);
        $date = Carbon::createFromDate($year, $month, $day);

        $events = AcademicEvent::whereDate('event_date', $date)->get();

        return view('akademik.Kalender.detail', compact('events', 'day', 'year', 'month', 'date'));
    }

    /**
     * Menampilkan detail event spesifik
     */
    public function showEvent(Request $request, $id)
    {
        $event = AcademicEvent::findOrFail($id);
        $year = $request->get('year', $event->event_date->year);
        $month = $request->get('month', $event->event_date->month);

        return view('akademik.Kalender.event', compact('event', 'year', 'month'));
    }
}
