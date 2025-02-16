<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <section class="container mx-auto p-6 bg-white rounded-lg shadow-lg max-w-lg">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex items-center space-x-4 border-b pb-4 mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Isi Presensi Hari Ini</h1>
        </div>

        @php
            $todayAttendance = auth()
                ->user()
                ->employee->attendances()
                ->whereDate('date', \Carbon\Carbon::today())
                ->first();
        @endphp

        <form action="{{ route('dashboard.attendances.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf

            <div x-data="{ imagePreview: null }">
                <label for="selfie" class="block text-sm font-medium">Ambil Foto Selfie</label>
                <input id="selfie" type="file" name="selfie" accept="image/*" capture="user"
                    class="mt-1 w-full border rounded-lg focus:outline-none file:mr-4 file:py-2.5 file:px-4 file:font-medium file:border-0 file:text-sm file:bg-black file:text-white hover:file:bg-yellow-500 transition ease-in-out duration-200"
                    @change="if ($event.target.files.length) { 
                                const file = $event.target.files[0]; 
                                const reader = new FileReader(); 
                                reader.onload = (e) => { imagePreview = e.target.result; }; 
                                reader.readAsDataURL(file); 
                            } else { imagePreview = null; }">

                <!-- Preview Gambar -->
                <div class="mt-4" x-show="imagePreview" style="display: none;">
                    <div class="overflow-auto max-w-full h-64 rounded-md shadow-md border border-gray-300">
                        <img :src="imagePreview" class="w-full h-auto" alt="Image Preview">
                    </div>
                </div>

                @error('selfie')
                    <p class="text-red-500 text-md mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center">
                @if (!$todayAttendance)
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md transition">Check
                        In</button>
                @elseif ($todayAttendance && !$todayAttendance->check_out)
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg shadow-md transition">Check
                        Out</button>
                @else
                    <p class="text-gray-500">Anda sudah melakukan check-in dan check-out hari ini.</p>
                @endif
            </div>
        </form>
    </section>
</x-app-layout>
