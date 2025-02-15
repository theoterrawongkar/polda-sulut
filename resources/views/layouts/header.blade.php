<!-- Bagian Header -->
<header class="flex items-center justify-between px-5 py-2 bg-[#ffdd19] shadow">
    <!-- Judul Halaman -->
    <div class="flex items-center space-x-2">
        <button @click="sidebarOpen = !sidebarOpen" aria-label="humberger button" class="lg:hidden focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
        <div class="w-32 md:w-56 lg:w-64 overflow-hidden whitespace-nowrap text-ellipsis">
            <h2 class="text-md md:text-lg lg:text-xl font-bold">@yield('pageTitle')</h2>
        </div>
    </div>
    <!-- Profil User -->
    <div class="flex items-center">
        <!-- Nama dan Jabatan -->
        <div class="text-right mr-2 hidden md:block">
            <h1 class="text-sm font-bold">
                {{ auth()->user()->employee->name }}
            </h1>
            <p class="text-xs text-gray-500 leading-none">
                {{ auth()->user()->role }}
            </p>
        </div>

        <div>
            <!-- Gambar Profil -->
            <img src="{{ auth()->user()->employee->image ? asset('storage/' . auth()->user()->employee->image) : asset('img/profile-placeholder.jpg') }}"
                alt="Profile" class="size-12 rounded-full border-2">
        </div>
    </div>
</header>
