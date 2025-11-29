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

    /**
     * Mengatur reminder untuk event (memerlukan login)
     */
    public function setReminder(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $event = AcademicEvent::findOrFail($id);

        $validated = $request->validate([
            'reminder_days' => 'required|integer|min:0|max:30'
        ]);

        $reminderTime = Carbon::parse($event->event_date)
                             ->subDays($validated['reminder_days'])
                             ->setTime(8, 0, 0);

        $existing = EventReminder::where('user_id', Auth::id())
                                ->where('academic_event_id', $id)
                                ->first();

        if ($existing) {
            $existing->update(['reminder_time' => $reminderTime]);
        } else {
            EventReminder::create([
                'user_id' => Auth::id(),
                'academic_event_id' => $id,
                'reminder_time' => $reminderTime,
                'is_sent' => false
            ]);
        }

        return back()->with('success', 'Reminder berhasil diatur!');
    }

    /**
     * Menghapus reminder event
     */
    public function removeReminder($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        EventReminder::where('user_id', Auth::id())
                    ->where('academic_event_id', $id)
                    ->delete();

        return back()->with('success', 'Reminder berhasil dihapus!');
    }
}
