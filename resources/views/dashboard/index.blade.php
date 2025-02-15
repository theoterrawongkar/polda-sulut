<x-app-layout>

    <!-- Judul Halaman -->
    <x-slot name="title">{{ $title }}</x-slot>

    <!-- Bagian Dashboard -->
    <section class="container mx-auto p-6 bg-white rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Employees -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Total Karyawan</h3>
                <p class="text-4xl font-bold">{{ $totalEmployees }}</p>
            </div>

            <!-- Employees Active -->
            <div class="bg-green-100 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Karyawan Aktif</h3>
                <p class="text-4xl font-bold text-green-600">{{ $activeEmployees }}</p>
            </div>

            <!-- Employees Inactive -->
            <div class="bg-red-100 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Karyawan Tidak Aktif</h3>
                <p class="text-4xl font-bold text-red-600">{{ $inactiveEmployees }}</p>
            </div>

            <!-- Employees by Gender (Pria) -->
            <div class="bg-blue-100 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Total Karyawan Pria</h3>
                <p class="text-4xl font-bold text-blue-600">{{ $maleEmployees }}</p>
            </div>

            <!-- Employees by Gender (Wanita) -->
            <div class="bg-pink-100 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Total Karyawan Wanita</h3>
                <p class="text-4xl font-bold text-pink-600">{{ $femaleEmployees }}</p>
            </div>

            <!-- Employee with Most Attendance -->
            <div class="bg-yellow-100 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Karyawan Terbaik</h3>
                <p class="text-md font-bold text-yellow-600">{{ $topEmployee->employee->name ?? 'N/A' }}</p>
                <p class="text-sm text-gray-600">Total Kehadiran: {{ $topEmployee->total_attendance ?? 0 }}</p>
            </div>
        </div>
    </section>

</x-app-layout>
