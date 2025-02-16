<!-- Bagian Sidebar -->
<div x-show="sidebarOpen" class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden" @click="sidebarOpen = false">
</div>
<aside
    class="fixed inset-y-0 z-30 w-64 bg-[#000000] shadow-md lg:static lg:shadow-none lg:translate-x-0 transform transition-transform duration-300"
    :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
    <div class="px-6 py-4 flex items-center gap-2">
        <x-application-logo class="size-14"></x-application-logo>
        <div>
            <h1 class="text-3xl font-bold text-white leading-none">
                POLDA <span class="block text-sm font-semibold text-[#ffdd19] leading-none">Sulawesi Utara</span>
            </h1>
        </div>
    </div>
    <nav class="flex-1 p-4 space-y-2 font-light">
        <div>
            <h3 class="px-2 py-1 font-medium text-[#ffdd19]">Menu</h3>
            <a href="{{ route('dashboard.index') }}"
                class="{{ Request::routeIs('dashboard.index') ? 'bg-gray-200 text-black animate-pulse' : 'text-white animate-none' }} flex gap-4 px-4 py-1.5 rounded hover:bg-gray-200 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                </svg>
                <span class="inline">Dashboard</span>
            </a>
            <a href="{{ route('dashboard.employees.index') }}"
                class="{{ Request::routeIs('dashboard.employees.*') ? 'bg-gray-200 text-black animate-pulse' : 'text-white animate-none' }} flex gap-4 px-4 py-1.5 rounded hover:bg-gray-200 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
                <span>Data Karyawan</span>
            </a>
        </div>
        <div>
            <h3 class="px-2 py-1 font-medium text-[#ffdd19]">Absensi</h3>
            <a href="#"
                class="{{ Request::routeIs('dashboard.reports.create') ? 'bg-gray-200 text-black animate-pulse' : 'text-white animate-none' }} flex gap-4 px-4 py-1.5 text-white rounded hover:bg-gray-200 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <span class="inline">Lihat Presensi</span>
            </a>
            <a href="#"
                class="{{ Request::routeIs('dashboard.reports.received') ? 'bg-gray-200 text-black animate-pulse' : 'text-white animate-none' }} flex gap-4 px-4 py-1.5 text-white rounded hover:bg-gray-200 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                </svg>
                <span>Input Presensi</span>
            </a>
        </div>
        <div>
            <h3 class="px-2 py-1 font-medium text-[#ffdd19]">Lainnya</h3>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="flex w-full gap-4 px-4 py-1.5 text-white rounded hover:bg-gray-200 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </nav>
</aside>
