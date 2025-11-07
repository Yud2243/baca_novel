<nav x-data="{ open: false }" class="bg-green-700 dark:bg-green-800 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Logo & Navigasi Utama (Kiri) --><div class="flex items-center">
                
                <!-- Logo Bundar --><div class="shrink-0 mr-4">
                    <a href="{{ route('dashboard') }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-white dark:bg-gray-700">
                        <!-- Ini adalah placeholder untuk logo Anda, bisa diganti dengan SVG/IMG asli nanti --><span class="text-lg font-bold text-green-700 dark:text-white">LOGO</span>
                    </a>
                </div>

                <!-- Navigation Links (Desktop) --><div class="hidden space-x-6 sm:-my-px sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Beranda') }}
                    </x-nav-link>
                    <x-nav-link :href="route('books.index')" :active="request()->routeIs('books.*')">
                        {{ __('Novel') }}
                    </x-nav-link>
                    <x-nav-link :href="route('dashboard')" :active="false">
                        {{ __('About') }}
                    </x-nav-link>
                    <!-- Admin Panel tidak lagi di navbar utama, akan diakses via URL langsung -->@if(Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-200 hover:text-white ml-6">Admin Panel</a>
                    @endif
                </div>
            </div>

            <!-- Bagian Kanan: Search & User Profile --><div class="hidden sm:flex sm:items-center sm:ml-6 space-x-4">
                
                <!-- Kotak Pencarian --><div class="relative flex items-center bg-green-600 dark:bg-green-700 rounded-full px-4 py-2">
                    <input type="text" placeholder="Search..." class="bg-transparent border-none focus:ring-0 text-white placeholder-green-200 text-sm w-40">
                    <button class="text-green-200 hover:text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </div>

                <!-- Ikon Profil Pengguna (Bulat) --><!-- Ini akan kita buat sebagai dropdown profil pengguna --><x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center justify-center w-10 h-10 rounded-full bg-green-600 dark:bg-green-700 text-green-200 hover:text-white focus:outline-none transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4.002 4.002 0 11-8 0 4.002 4.002 0 018 0z" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ Auth::user()->name }}
                        </div>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile) --><div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-green-200 hover:text-white hover:bg-green-600 focus:outline-none focus:bg-green-600 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) --><div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-green-600 dark:bg-green-700">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Beranda') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('books.index')" :active="request()->routeIs('books.*')">
                {{ __('Novel') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dashboard')" :active="false">
                {{ __('About') }}
            </x-responsive-nav-link>
            @if(Auth::user()->is_admin)
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">
                {{ __('Admin Panel') }}
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options --><div class="pt-4 pb-1 border-t border-green-500 dark:border-green-600">
            <div class="px-4">
                <div class="font-medium text-base text-white dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-green-200 dark:text-gray-400">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>