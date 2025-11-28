<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicEvent;
use App\Models\EventReminder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AkademikController extends Controller
{
    // Halaman index kalender
    public function index(Request $request)
    {
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        // Ambil semua event untuk bulan ini
        $events = AcademicEvent::whereYear('event_date', $year)
                              ->whereMonth('event_date', $month)
                              ->get();

        return view('akademik.Kalender.index', compact('year', 'month', 'events'));
    }

    // Detail tanggal tertentu
    public function detail($day)
    {
        $year = request()->get('year', now()->year);
        $month = request()->get('month', now()->month);

        $date = Carbon::createFromDate($year, $month, $day);

        // Ambil event pada tanggal ini
        $events = AcademicEvent::whereDate('event_date', $date)->get();

        return view('akademik.Kalender.detail', compact('date', 'events', 'year', 'month'));
    }

    // Detail event spesifik
    public function showEvent($id)
    {
        $event = AcademicEvent::findOrFail($id);

        $hasReminder = false;
        if (Auth::check()) {
            $hasReminder = EventReminder::where('user_id', Auth::id())
                                       ->where('academic_event_id', $id)
                                       ->exists();
        }

        return view('akademik.Kalender.event', compact('event', 'hasReminder'));
    }

    // Set reminder untuk event
    public function setReminder(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $event = AcademicEvent::findOrFail($id);

        $validated = $request->validate([
            'reminder_days' => 'required|integer|min:0|max:30'
        ]);

        // Hitung waktu reminder
        $reminderTime = Carbon::parse($event->event_date)
                             ->subDays($validated['reminder_days'])
                             ->setTime(8, 0, 0);

        // Cek apakah sudah ada reminder
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

    // Hapus reminder
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
