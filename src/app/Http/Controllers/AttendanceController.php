<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\BreakTime;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    // 出勤登録画面
    public function index()
    {
        $today = Carbon::today();

        $attendance = Attendance::where('user_id', auth()->id())
            ->whereDate('date', $today)
            ->with('breakTimes')
            ->first();

        // ステータス判定
        $status = '勤務外';

        if ($attendance) {
            if ($attendance->clock_out) {
                $status = '退勤済';
            } else {
                $lastBreak = $attendance->breakTimes->last();

                if ($lastBreak && !$lastBreak->break_out) {
                    $status = '休憩中';
                } else {
                    $status = '出勤中';
                }
            }
        }

        $now = now();

        return view('attendance.index', compact('attendance', 'status', 'now'));
    }

    // 出勤
    public function clockIn()
    {
        $today = Carbon::today();

        $exists = Attendance::where('user_id', auth()->id())
            ->whereDate('date', $today)
            ->exists();

        if ($exists) {
            return back()->with('error', '本日はすでに出勤済みです');
        }

        Attendance::create([
            'user_id' => auth()->id(),
            'date' => $today,
            'clock_in' => now(),
        ]);

        return redirect()->route('attendance.index');
    }

    // 休憩入
    public function breakIn()
    {
        $attendance = Attendance::where('user_id', auth()->id())
            ->whereDate('date', now())
            ->first();

        BreakTime::create([
            'attendance_id' => $attendance->id,
            'break_in' => now(),
        ]);

        return back();
    }

    // 休憩戻
    public function breakOut()
    {
        $attendance = Attendance::where('user_id', auth()->id())
            ->whereDate('date', now())
            ->first();

        $break = $attendance->breakTimes()
            ->whereNull('break_out')
            ->latest()
            ->first();

        if ($break) {
            $break->update([
                'break_out' => now(),
            ]);
        }

        return back();
    }

    // 退勤
    public function clockOut()
    {
        $attendance = Attendance::where('user_id', auth()->id())
            ->whereDate('date', now())
            ->first();

        if ($attendance->clock_out) {
            return back();
        }

        $attendance->update([
            'clock_out' => now(),
        ]);

        return redirect()->route('attendance.index')
            ->with('message', 'お疲れ様でした。');
    }

    // 勤怠一覧
    public function list()
    {
        $attendances = Attendance::where('user_id', auth()->id())->get();

        return view('attendance.list', compact('attendances'));
    }

    // 詳細
    public function detail($id)
    {
        $attendance = Attendance::with('breakTimes')->findOrFail($id);

        return view('attendance.detail', compact('attendance'));
    }
}