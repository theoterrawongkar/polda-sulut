<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function show()
    {
        // Ambil user yang sedang login
        $employee = Auth::user()->employee;

        if (!$employee) {
            return redirect()->back()->with('error', 'Data karyawan tidak ditemukan.');
        }

        $attendances = Attendance::where('employee_id', $employee->id)
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->orderBy('date', 'asc')
            ->get();

        // Judul Halaman
        $title = "Presensi Saya";

        return view('dashboard.attendance.show', compact('title', 'attendances'));
    }

    public function create()
    {
        // Judul Halaman
        $title = "Input Presensi";

        return view('dashboard.attendance.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'selfie' => 'required|max:4000|image|mimes:png,jpg,jpeg',
        ]);

        $employeeId =  Auth::user()->employee->id;
        $today = Carbon::today();

        // Cek apakah ada absensi untuk hari ini
        $attendance = Attendance::where('employee_id', $employeeId)
            ->whereDate('date', $today)
            ->first();

        // Simpan foto jika ada
        $selfiePath = null;
        if ($request->hasFile('selfie')) {
            $selfiePath = $request->file('selfie')->store('selfie_check_in', 'public');
            $selfiePath = $selfiePath;
        }

        if (!$attendance) {
            // Jika belum ada, lakukan check-in
            $attendance = Attendance::create([
                'employee_id' => $employeeId,
                'date' => $today,
                'check_in' => Carbon::now()->format('H:i:s'),
                'selfie_check_in' => $selfiePath,
            ]);

            return redirect()->back()->with('success', 'Check-in berhasil!');
        } elseif (!$attendance->check_out) {
            // Jika sudah check-in tetapi belum check-out, lakukan check-out
            $selfieOutPath = null;
            if ($request->hasFile('selfie')) {
                $selfieOutPath = $request->file('selfie')->store('selfie_check_out', 'public');
                $selfieOutPath = $selfieOutPath;
            }

            $attendance->update([
                'check_out' => Carbon::now()->format('H:i:s'),
                'selfie_check_out' => $selfieOutPath,
            ]);

            return redirect()->back()->with('success', 'Check-out berhasil!');
        }

        return redirect()->back()->with('error', 'Anda sudah melakukan check-in dan check-out hari ini.');
    }
}
