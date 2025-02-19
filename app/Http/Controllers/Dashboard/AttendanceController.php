<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Employee;
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

    public function indexEmployeeAttendance(Request $request)
    {
        // Validasi Search Form
        $validated = $request->validate([
            'status' => 'nullable|string|in:1,0,all',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'search' => 'nullable|string|max:50',
        ]);

        // Ambil Nilai
        $status = $validated['status'] ?? 'all';
        $start_date = $validated['start_date'] ?? null;
        $end_date = $validated['end_date'] ?? null;
        $search = $validated['search'] ?? null;

        // Semua Karyawan Dengan Data Berita dan Laporan
        $employees = Employee::when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('nrp', 'LIKE', "{$search}%")
                    ->orWhere('gender', 'LIKE', "{$search}");
            });
        })
            ->when($status !== 'all', function ($query) use ($status) {
                if (is_numeric($status)) {
                    return $query->where('status', (bool) $status);
                }
            })
            ->when($start_date, function ($query) use ($start_date) {
                return $query->whereDate('created_at', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                return $query->whereDate('created_at', '<=', $end_date);
            })
            ->orderBy('name', 'ASC')
            ->paginate(10);

        // Judul Halaman
        $title = "Absensi";

        return view('dashboard.attendance.index-attendance', compact('title', 'employees', 'status', 'start_date', 'end_date', 'search'));
    }

    public function showEmployeeAttendance(string $nrp)
    {
        // Cari karyawan berdasarkan NRP
        $employee = Employee::where('nrp', $nrp)->firstOrFail();

        // Ambil semua data absensi karyawan ini, diurutkan dari terbaru
        $attendances = $employee->attendances()->orderBy('date', 'desc')->get();

        // Judul Halaman
        $title = "Ubah";

        return view('dashboard.attendance.show-attendance', compact('title', 'employee', 'attendances'));
    }

    public function storeEmployeeAttendance(Request $request, string $nrp)
    {
        $employee = Employee::where('nrp', $nrp)->firstOrFail();

        $validated = $request->validate([
            'date' => 'required|date',
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i',
        ]);

        // Konversi ke format TIME MySQL
        $checkIn = $validated['check_in'] ? Carbon::createFromFormat('H:i', $validated['check_in'])->format('H:i:s') : null;
        $checkOut = $validated['check_out'] ? Carbon::createFromFormat('H:i', $validated['check_out'])->format('H:i:s') : null;

        // Cek apakah sudah ada data absensi untuk karyawan & tanggal yang sama
        $existingAttendance = Attendance::where('employee_id', $employee->id)
            ->where('date', $validated['date'])
            ->first();

        if ($existingAttendance) {
            return back()->with('error', 'Karyawan ini sudah memiliki absensi pada tanggal ini!');
        }

        Attendance::create([
            'employee_id' => $employee->id,
            'date' => $validated['date'],
            'check_in' => $checkIn,
            'check_out' => $checkOut,
        ]);

        return back()->with('success', 'Absensi berhasil ditambahkan!');
    }

    public function updateEmployeeAttendance(Request $request, string $nrp, string $attendanceId)
    {
        $employee = Employee::where('nrp', $nrp)->firstOrFail();
        $attendance = Attendance::where('id', $attendanceId)
            ->where('employee_id', $employee->id)
            ->firstOrFail();

        $validated = $request->validate([
            'date' => 'required|date',
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i',
        ]);

        // Konversi format TIME agar sesuai dengan database
        $checkIn = $validated['check_in'] ? Carbon::createFromFormat('H:i', $validated['check_in'])->format('H:i:s') : null;
        $checkOut = $validated['check_out'] ? Carbon::createFromFormat('H:i', $validated['check_out'])->format('H:i:s') : null;

        // Cek apakah ada absensi lain dengan tanggal yang sama (kecuali yang sedang di-update)
        $existingAttendance = Attendance::where('employee_id', $employee->id)
            ->where('date', $validated['date'])
            ->where('id', '!=', $attendanceId) // Exclude current attendance
            ->first();

        if ($existingAttendance) {
            return back()->with('error', 'Karyawan ini sudah memiliki absensi pada tanggal ini!');
        }

        $attendance->update([
            'date' => $validated['date'],
            'check_in' => $checkIn,
            'check_out' => $checkOut,
        ]);

        return back()->with('success', 'Absensi berhasil diperbarui!');
    }
}
