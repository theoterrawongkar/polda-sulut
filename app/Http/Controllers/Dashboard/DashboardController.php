<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Karyawan
        $totalEmployees = Employee::count();
        $activeEmployees = Employee::where('status', true)->count();
        $inactiveEmployees = Employee::where('status', false)->count();
        $maleEmployees = Employee::where('gender', 'Pria')->count();
        $femaleEmployees = Employee::where('gender', 'Wanita')->count();

        // Ambil karyawan dengan jumlah absensi terbanyak dalam bulan ini
        $topEmployee = Attendance::with('employee') // Pastikan relasi dipanggil
            ->select('employee_id', DB::raw('COUNT(*) as total_attendance'))
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->groupBy('employee_id')
            ->orderByDesc('total_attendance')
            ->first();


        // Judul Halaman
        $title = "Dashboard";

        return view('dashboard.index', compact(
            'title',
            'totalEmployees',
            'activeEmployees',
            'inactiveEmployees',
            'maleEmployees',
            'femaleEmployees',
            'topEmployee'
        ));
    }
}
