<nav x-data="{ open: false }" class="bg-green-700 dark:bg-green-800 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo & Navigasi Kiri -->
            <div class="flex items-center space-x-8">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-white tracking-wide">
                    CANOVEL
                </a>

                <div class="hidden sm:flex space-x-6">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Beranda') }}
                    </x-nav-link>
                    <x-nav-link :href="route('books.index')" :active="request()->routeIs('books.*')">
                        {{ __('Novel') }}
                    </x-nav-link>
                    <x-nav-link :href="route('dashboard')" :active="false">
                        {{ __('About') }}
                    </x-nav-link>

                    @if(Auth::user()->is_admin)
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">
                            {{ __('Admin Panel') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Search + Profil -->
            <div class="hidden sm:flex sm:items-center space-x-5">
                <!-- Search -->
                <div class="relative flex items-center bg-green-600 dark:bg-green-700 rounded-full px-4 py-2">
                    <input type="text" placeholder="Search..." class="bg-transparent border-none focus:ring-0 text-white placeholder-green-200 text-sm w-40">
                    <button class="text-green-200 hover:text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>

                <!-- Profil Elegan -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-2 bg-green-600 dark:bg-green-700 rounded-full pl-3 pr-3 py-1 text-white hover:bg-green-500 transition-all duration-200 focus:outline-none">
                            <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                            <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4.002 4.002 0 11-8 0 4.002 4.002 0 018 0z" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="rounded-xl bg-white dark:bg-gray-800 shadow-lg overflow-hidden">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-300">{{ Auth::user()->email }}</p>
                            </div>
                            <x-dropdown-link :href="route('profile.edit')" class="text-gray-700 dark:text-white hover:bg-green-100 dark:hover:bg-green-700 rounded-xl">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" 
                                    class="text-gray-700 dark:text-white hover:bg-green-100 dark:hover:bg-green-700 rounded-xl"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-green-600 focus:outline-none focus:bg-green-600 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-green-600 dark:bg-green-700">
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

        <div class="pt-4 pb-1 border-t border-green-500 dark:border-green-600">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-green-200">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
