<x-app-layout>

    <!-- Judul Halaman -->
    <x-slot name="title">{{ $title }}</x-slot>

    <!-- Bagian Tambah Karyawan -->
    <section class="container mx-auto p-6 bg-white rounded-lg">
        <div class="flex items-center space-x-4 border-b pb-4 mb-6">
            <h1 class="text-2xl font-bold">Tambah Karyawan</h1>
        </div>
        <!-- Form Tambah Karyawan -->
        <form action="{{ route('dashboard.employees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2 class="text-lg font-semibold mb-2">Informasi Karyawan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Informasi Utama Karyawan (Kiri) -->
                <div>
                    <div class="space-y-2">
                        <!-- NIP -->
                        <div>
                            <label for="nrp" class="block font-medium text-sm">NRP</label>
                            <input id="nrp" name="nrp" type="number" value="{{ old('nrp') }}"
                                class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                            @error('nrp')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Nama -->
                        <div>
                            <label for="name" class="block font-medium text-sm">Nama</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}"
                                class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                            @error('name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Jenis Kelamin -->
                        <div>
                            <label for="gender" class="block font-medium text-sm">Jenis
                                Kelamin</label>
                            <select id="gender" name="gender"
                                class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                                <option value="Pria" {{ old('gender') == 'Pria' ? 'selected' : '' }}>Pria
                                </option>
                                <option value="Wanita" {{ old('gender') == 'Wanita' ? 'selected' : '' }}>Wanita
                                </option>
                            </select>
                            @error('gender')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Jabatan -->
                        <div>
                            <label for="position" class="block font-medium text-sm">Jabatan</label>
                            <input id="position" name="position" type="text" value="{{ old('position') }}"
                                class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                            @error('position')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tanggal Lahir -->
                        <div>
                            <label for="date_of_birth" class="block font-medium text-sm text-gray-700">Tanggal
                                Lahir</label>
                            <input id="date_of_birth" name="date_of_birth" type="date"
                                value="{{ old('date_of_birth') }}"
                                class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                            @error('date_of_birth')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Informasi Utama Karyawan (Kanan) -->
                <div>
                    <div class="space-y-2">
                        <!-- Alamat -->
                        <div>
                            <label for="address" class="block font-medium text-sm">Alamat</label>
                            <textarea id="address" name="address" rows="4" class="mt-1 p-2 w-full border rounded-lg focus:outline-none">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Telepon -->
                        <div>
                            <label for="phone" class="block font-medium text-sm">No. Telepon</label>
                            <input id="phone" name="phone" type="number" value="{{ old('phone') }}"
                                class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                            @error('phone')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Status -->
                        <div>
                            <label for="status" class="block font-medium text-sm">Status</label>
                            <select id="status" name="status"
                                class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Non Aktif
                                </option>
                            </select>
                            @error('status')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Gambar -->
                        <div x-data="{ imagePreview: null }">
                            <label for="picture" class="block text-sm font-medium">Foto Profil</label>
                            <input id="picture" type="file" name="picture"
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
                            @error('picture')
                                <p class="text-red-500 text-md mt-2">{{ $message }}</p>
                            @enderror
                        </div>
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
                        <select id="role" name="role"
                            class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                            <option value="User" {{ old('role') == 'User' ? 'selected' : '' }}>User
                            </option>
                            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin
                            </option>
                        </select>
                        @error('role')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Name User -->
                    <div>
                        <label for="username" class="block font-medium text-sm">Username</label>
                        <input id="username" name="username" type="text" value="{{ old('username') }}"
                            class="mt-1 p-2 w-full border rounded-lg focus:outline-none">
                        @error('username')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Email User -->
                    <div>
                        <label for="email" class="block font-medium text-sm">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
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
                    class="bg-gray-700 hover:bg-gray-800 text-white px-6 py-2 rounded-lg transition duration-200">
                    Kembali
                </a>
                <button type="submit"
                    class="bg-green-500 hover:bg-green-800 text-white px-6 py-2 rounded-lg transition duration-200">
                    Simpan
                </button>
            </div>
        </form>
    </section>

</x-app-layout>
