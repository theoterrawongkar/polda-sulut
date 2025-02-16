<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <section class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold mb-4 text-center">Riwayat Presensi Bulan Ini</h1>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 text-sm md:text-base">
                <thead>
                    <tr class="bg-yellow-400 text-gray-900">
                        <th class="border p-3">Tanggal</th>
                        <th class="border p-3">Check In</th>
                        <th class="border p-3">Check Out</th>
                        <th class="border p-3">Selfie Check In</th>
                        <th class="border p-3">Selfie Check Out</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attendances as $attendance)
                        <tr class="border text-center hover:bg-gray-100">
                            <td class="p-3">{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                            <td class="p-3">
                                {{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('H:i') : '-' }}
                            </td>
                            <td class="p-3">
                                {{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i') : '-' }}
                            </td>
                            <td class="p-3 text-center">
                                @if ($attendance->selfie_check_in)
                                    <img src="{{ asset('storage/' . $attendance->selfie_check_in) }}"
                                        class="h-16 w-16 object-cover rounded-md border border-gray-300 shadow-sm mx-auto">
                                @else
                                    -
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                @if ($attendance->selfie_check_out)
                                    <img src="{{ asset('storage/' . $attendance->selfie_check_out) }}"
                                        class="h-16 w-16 object-cover rounded-md border border-gray-300 shadow-sm mx-auto">
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">Belum ada data absensi untuk bulan
                                ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>
