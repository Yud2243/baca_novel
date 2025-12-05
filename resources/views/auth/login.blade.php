<x-guest-layout>
    <div class="relative w-full max-w-md backdrop-blur-xl 
                bg-white/15 border border-white/30
                rounded-3xl shadow-[0_8px_32px_rgba(0,0,0,0.35)]
                px-10 py-12">

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
            <div class="mb-6">
                <x-input-label for="password" class="text-white/90 font-semibold" value="Password" />
                <x-text-input id="password" type="password" name="password"
                    class="block mt-1 w-full bg-white/70
                           rounded-xl border-0 focus:ring-2 focus:ring-green-400
                           text-gray-900"
                    required />
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
</x-guest-layout>
