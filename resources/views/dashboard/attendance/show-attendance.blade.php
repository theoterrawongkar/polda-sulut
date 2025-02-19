<x-app-layout>

    <x-slot name="title">Data Absensi - {{ $employee->name }}</x-slot>

    <section class="container mx-auto p-6 bg-white rounded-lg">
        <h1 class="text-xl font-bold mb-4">Riwayat Absensi: {{ $employee->name }} ({{ $employee->nrp }})</h1>

        <div x-data="{ open: false }">
            <!-- Button to open modal -->
            <div class="flex justify-end ">
                <button @click="open = true" class="mb-5 px-3 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md">
                    Tambah Presensi
                </button>
            </div>

            <!-- Modal -->
            <div x-show="open" class="fixed inset-0 flex items-center justify-center"
                style="background-color: rgba(0, 0, 0, 0.5)" x-cloak>
                <div class="bg-white p-5 rounded-lg shadow-lg w-1/3">
                    <h2 class="text-lg font-bold mb-4">Tambah Presensi</h2>

                    <form action="{{ route('dashboard.attendances.storeEmployeeAttendance', $employee->nrp) }}"
                        method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input id="date" type="date" name="date" class="w-full p-2 border rounded-md">
                            @error('date')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="check_in" class="block text-sm font-medium text-gray-700">Check In</label>
                            <input id="check_in" type="time" name="check_in" class="w-full p-2 border rounded-md">
                            @error('check_in')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="check_out" class="block text-sm font-medium text-gray-700">Check Out</label>
                            <input id="check_out" type="time" name="check_out" class="w-full p-2 border rounded-md">
                            @error('check_out')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-2">
                            <button type="button" @click="open = false"
                                class="px-3 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md">Batal</button>
                            <button type="submit"
                                class="px-3 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="p-3 mb-4 text-green-700 bg-green-200 border border-green-400 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="p-3 mb-4 text-red-700 bg-red-200 border border-red-400 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-xl">
            <table class="min-w-full bg-gray-100 shadow-md">
                <thead class="bg-[#ffdd19] text-black">
                    <tr>
                        <th class="text-center py-3 px-2 uppercase font-semibold text-sm">Tanggal</th>
                        <th class="text-center py-3 px-2 uppercase font-semibold text-sm">Check In</th>
                        <th class="text-center py-3 px-2 uppercase font-semibold text-sm">Check Out</th>
                        <th class="text-center py-3 px-2 uppercase font-semibold text-sm">Selfie Check In</th>
                        <th class="text-center py-3 px-2 uppercase font-semibold text-sm">Selfie Check Out</th>
                        <th class="text-center py-3 px-2 uppercase font-semibold text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attendances as $attendance)
                        <tr class="border-t hover:bg-blue-100 transition duration-200">
                            <td class="py-3 px-2 text-center">
                                {{ \Carbon\Carbon::parse($attendance->date)->translatedFormat('d M Y') }}</td>
                            <td class="py-3 px-2 text-center">
                                {{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('H:i') : '-' }}
                            </td>
                            <td class="py-3 px-2 text-center">
                                {{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i') : '-' }}
                            </td>
                            <td class="py-3 px-2 text-center">
                                @if ($attendance->selfie_check_in)
                                    <img src="{{ asset('storage/' . $attendance->selfie_check_in) }}"
                                        class="w-12 h-12 rounded-full mx-auto">
                                @else
                                    -
                                @endif
                            </td>
                            <td class="py-3 px-2 text-center">
                                @if ($attendance->selfie_check_out)
                                    <img src="{{ asset('storage/' . $attendance->selfie_check_out) }}"
                                        class="w-12 h-12 rounded-full mx-auto">
                                @else
                                    -
                                @endif
                            </td>
                            <td class="py-3 px-2 whitespace-nowrap">
                                <div class="flex justify-center space-x-1">
                                    <div x-data="{ open: false }">
                                        <!-- Button to open modal -->
                                        <div class="flex justify-end ">
                                            <button @click="open = true"
                                                class="p-2 text-sm font-medium bg-yellow-600 hover:bg-yellow-700 text-white rounded-md">
                                                Ubah
                                            </button>
                                        </div>

                                        <!-- Modal -->
                                        <div x-show="open" class="fixed inset-0 flex items-center justify-center"
                                            style="background-color: rgba(0, 0, 0, 0.5)" x-cloak>
                                            <div class="bg-white p-5 rounded-lg shadow-lg w-1/3">
                                                <h2 class="text-lg font-bold mb-4">Ubah Presensi</h2>

                                                <form
                                                    action="{{ route('dashboard.attendances.updateEmployeeAttendance', [$employee->nrp, $attendance->id]) }}"
                                                    method="POST" class="space-y-4">
                                                    @csrf
                                                    @method('PUT')

                                                    <div>
                                                        <label for="date"
                                                            class="block text-sm font-medium text-gray-700">Tanggal</label>
                                                        <input id="date" type="date" name="date"
                                                            value="{{ old('date', \Carbon\Carbon::parse($attendance->date)->format('Y-m-d')) }}"
                                                            class="w-full p-2 border rounded-md">
                                                    </div>

                                                    <div>
                                                        <label for="check_in"
                                                            class="block text-sm font-medium text-gray-700">Check
                                                            In</label>
                                                        <input id="check_in" type="time" name="check_in"
                                                            value="{{ old('check_in', $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('H:i') : '') }}"
                                                            class="w-full p-2 border rounded-md">
                                                    </div>

                                                    <div>
                                                        <label for="check_out"
                                                            class="block text-sm font-medium text-gray-700">Check
                                                            Out</label>
                                                        <input id="check_out" type="time" name="check_out"
                                                            value="{{ old('check_out', $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i') : '') }}"
                                                            class="w-full p-2 border rounded-md">
                                                    </div>

                                                    <div class="flex justify-end space-x-2">
                                                        <button type="button" @click="open = false"
                                                            class="px-3 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md">Batal</button>
                                                        <button type="submit"
                                                            class="px-3 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-2">
                                <h1 class="text-md font-semibold text-yellow-500">Tidak ada data absensi</h1>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <a href="{{ route('dashboard.attendances.indexEmployeeAttendance') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Kembali
            </a>
        </div>
    </section>

</x-app-layout>
