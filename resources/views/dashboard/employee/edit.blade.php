<x-app-layout>

    <!-- Judul Halaman -->
    <x-slot name="title">Edit Karyawan</x-slot>

    <!-- Bagian Edit Karyawan -->
    <section class="container mx-auto p-6 bg-white rounded-lg">
        <div class="flex items-center space-x-4 border-b pb-4 mb-6">
            <h1 class="text-2xl font-bold">Edit Karyawan</h1>
        </div>
        <!-- Form Edit Karyawan -->
        <form action="{{ route('dashboard.employees.update', $employee->nrp) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h2 class="text-lg font-semibold mb-2">Informasi Karyawan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Informasi Karyawan (Kiri) -->
                <div class="space-y-2">
                    <div>
                        <label for="nrp" class="block font-medium text-sm">NRP</label>
                        <input id="nrp" name="nrp" type="number" value="{{ old('nrp', $employee->nrp) }}"
                            class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                        @error('nrp')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="name" class="block font-medium text-sm">Nama</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $employee->name) }}"
                            class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="gender" class="block font-medium text-sm">Jenis Kelamin</label>
                        <select id="gender" name="gender"
                            class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                            <option value="Pria" {{ old('gender', $employee->gender) == 'Pria' ? 'selected' : '' }}>
                                Pria</option>
                            <option value="Wanita" {{ old('gender', $employee->gender) == 'Wanita' ? 'selected' : '' }}>
                                Wanita</option>
                        </select>
                        @error('gender')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="position" class="block font-medium text-sm">Jabatan</label>
                        <input id="position" name="position" type="text"
                            value="{{ old('position', $employee->position) }}"
                            class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                        @error('position')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="date_of_birth" class="block font-medium text-sm">Tanggal Lahir</label>
                        <input id="date_of_birth" name="date_of_birth" type="date"
                            value="{{ old('date_of_birth') ?? \Carbon\Carbon::parse($employee->date_of_birth)->format('Y-m-d') }}"
                            class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                        @error('date_of_birth')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Informasi Karyawan (Kanan) -->
                <div class="space-y-2">
                    <div>
                        <label for="address" class="block font-medium text-sm">Alamat</label>
                        <textarea id="address" name="address" rows="4" class="mt-1 p-2 w-full border rounded-lg focus:outline-none">{{ old('address', $employee->address) }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="phone" class="block font-medium text-sm">No. Telepon</label>
                        <input id="phone" name="phone" type="number"
                            value="{{ old('phone', $employee->phone) }}"
                            class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="status" class="block font-medium text-sm">Status</label>
                        <select id="status" name="status"
                            class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                            <option value="1" {{ old('status', $employee->status) == '1' ? 'selected' : '' }}>
                                Aktif
                            </option>
                            <option value="0" {{ old('status', $employee->status) == '0' ? 'selected' : '' }}>Non
                                Aktif</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="picture" class="block text-sm font-medium">Foto Profil</label>
                        <input id="picture" type="file" name="picture"
                            class="mt-1 w-full border rounded-lg focus:outline-none">
                        @if ($employee->picture)
                            <img src="{{ asset('storage/' . $employee->picture) }}"
                                class="mt-4 w-32 h-32 object-cover rounded-md">
                        @endif
                        @error('picture')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Informasi User -->
            <div class="mt-6">
                <h2 class="text-lg font-semibold mb-2">Informasi User</h2>
                <div class="space-y-2">
                    <!-- Role User -->
                    <div>
                        <label for="role" class="block font-medium text-sm">Role</label>
                        <select id="role" name="role" required
                            class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                            <option value="User"
                                {{ old('role', $employee->user->role) === 'User' ? 'selected' : '' }}>Petugas
                            </option>
                            <option value="Admin"
                                {{ old('role', $employee->user->role) === 'Admin' ? 'selected' : '' }}>Admin
                            </option>
                        </select>
                        @error('role')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Name User -->
                    <div>
                        <label for="username" class="block font-medium text-sm">Username</label>
                        <input id="username" name="username" type="text"
                            value="{{ old('username', $employee->user->name) }}" required
                            class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                        @error('username')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Email User -->
                    <div>
                        <label for="email" class="block font-medium text-sm">Email</label>
                        <input id="email" name="email" type="email"
                            value="{{ old('email', $employee->user->email) }}" required
                            class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                        @error('email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Password User -->
                    <div>
                        <label for="password" class="block font-medium text-sm">Password</label>
                        <input id="password" name="password" type="password"
                            class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                        @error('password')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Konfirmasi Password -->
                    <div>
                        <label for="password_confirmation" class="block font-medium text-sm">Konfirmasi
                            Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                        @error('password_confirmation')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Tombol Kembali & Simpan -->
            <div class="flex justify-end space-x-2 mt-5">
                <a href="{{ route('dashboard.employees.index') }}"
                    class="bg-gray-700 hover:bg-gray-800 text-white px-6 py-2 rounded-lg transition duration-200">Kembali</a>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-800 text-white px-6 py-2 rounded-lg transition duration-200">Update</button>
            </div>
        </form>
    </section>

</x-app-layout>
