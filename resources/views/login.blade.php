<x-guest-layout>

    <!-- Judul Halaman -->
    <x-slot name="title">{{ $title }}</x-slot>

    <!-- Bagian Login -->
    <div class="relative min-h-screen flex items-center justify-center bg-cover bg-center"
        style="background-image: url('{{ asset('img/application-img.jpg') }}');">

        <!-- Overlay Gelap -->
        <div class="absolute inset-0 bg-black opacity-75"></div>

        <!-- Form Login -->
        <div class="relative text-white w-full max-w-md p-8">
            <div class="flex items-center justify-center gap-4 mb-8 hover:scale-105 transition duration-300">
                <x-application-logo class="w-24 h-24"></x-application-logo>
                <div class="text-left">
                    <h1 class="text-lg font-bold leading-tight text-[#ffdd19]">Sistem Informasi Absensi</h1>
                    <h2 class="text-3xl font-bold leading-tight">Kepolisian Daerah</h2>
                    <h3 class="text-lg font-normal leading-tight">Sulawesi Utara</h3>
                </div>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-[#ffdd19]">Email</label>
                    <input id="email" type="email" name="email" required autofocus
                        class="mt-1 block w-full px-3 py-1 bg-gray-200 bg-opacity-20 border border-[#000000] rounded-md shadow-sm focus:ring focus:ring-none focus:outline-none text-[#000000] placeholder-gray-200">

                    <!-- Pesan Error -->
                    @error('email')
                        <p class="text-[#ffdd19] text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-[#ffdd19]">Password</label>
                    <input id="password" type="password" name="password" required
                        class="mt-1 block w-full px-3 py-1 bg-gray-200 bg-opacity-20 border border-[#000000] rounded-md shadow-sm focus:ring focus:ring-none focus:outline-none text-[#000000] placeholder-gray-200">
                </div>

                <!-- Remember Me & Lupa Password -->
                <div class="flex items-center justify-between mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="text-blue-400">
                        <span class="ml-2 text-sm">Ingat Saya</span>
                    </label>
                    <a href="#" class="text-sm text-blue-500 hover:underline">Lupa Password?</a>
                </div>

                <!-- Tombol Login -->
                <div>
                    <button type="submit"
                        class="w-full bg-[#000000] hover:bg-[#ffdd19] text-white hover:text-[#000000] font-semibold py-2 px-4 rounded-md transition">
                        Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-guest-layout>
