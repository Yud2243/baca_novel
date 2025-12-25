<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6">
        <!-- Wrapper form -->
        <div class="relative w-full max-w-md backdrop-blur-xl 
                    bg-white/15 border border-white/30
                    rounded-3xl shadow-[0_8px_32px_rgba(0,0,0,0.35)]
                    px-10 py-12"
             x-data="{ showPassword: false }"> <!-- Alpine.js untuk toggle password -->

            <h1 class="text-3xl font-extrabold text-center text-white mb-8 drop-shadow-lg">
                Masuk Akun
            </h1>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-5">
                    <x-input-label for="email" class="text-white/90 font-semibold" value="Email" />
                    <x-text-input id="email" type="email" name="email"
                        class="block mt-1 w-full bg-white/70
                               rounded-xl border-0 focus:ring-2 focus:ring-green-400 
                               text-gray-900"
                        required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-200 text-sm" />
                </div>

             <!-- Password -->
<div class="mb-6 relative" x-data="{ showPassword: false }">
    <x-input-label for="password" class="text-white/90 font-semibold" value="Password" />

    <div class="relative">
        <input :type="showPassword ? 'text' : 'password'"
               id="password"
               name="password"
               class="block mt-1 w-full bg-white/70 rounded-xl border-0 focus:ring-2 focus:ring-green-400 text-gray-900 pr-12"
               required />

        <!-- Tombol lihat sandi -->
        <button type="button"
                @click="showPassword = !showPassword"
                class="absolute inset-y-0 right-3 flex items-center justify-center text-gray-700">
            <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.964 9.964 0 012.342-3.436M6.1 6.1l11.8 11.8M9.88 9.88a3 3 0 104.24 4.24" />
            </svg>
        </button>
    </div>

    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-200 text-sm" />
</div>

                <!-- Remember -->
                <label class="flex items-center space-x-2 mb-6 text-white font-medium cursor-pointer">
                    <input id="remember_me" type="checkbox"
                           class="rounded border-white/40 text-green-500 focus:ring-green-500"
                           name="remember">
                    <span>Ingat saya</span>
                </label>

                <!-- Submit -->
                <button class="w-full bg-green-600 hover:bg-green-700
                               text-white font-bold py-3 rounded-xl
                               shadow-lg transition duration-200">
                    Masuk
                </button>

                <p class="text-center text-sm text-white mt-6 drop-shadow">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-green-300 hover:underline">
                        Daftar sekarang
                    </a>
                </p>
            </form>

        </div>
    </div>
</x-guest-layout>
