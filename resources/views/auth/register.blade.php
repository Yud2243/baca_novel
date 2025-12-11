<x-guest-layout>
    <div class="relative w-full max-w-md backdrop-blur-xl 
                bg-white/15 border border-white/30
                rounded-3xl shadow-[0_8px_32px_rgba(0,0,0,0.35)]
                px-10 py-12">

        <h1 class="text-3xl font-extrabold text-center text-white mb-8 drop-shadow-lg">
            Daftar Akun
        </h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-5">
                <x-input-label for="name" class="text-white/90 font-semibold" value="Nama Lengkap" />
                <x-text-input id="name" type="text" name="name"
                    class="block mt-1 w-full bg-white/70 rounded-xl border-0 
                           focus:ring-2 focus:ring-green-400 text-gray-900"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-200 text-sm" />
            </div>

            <!-- Email -->
            <div class="mb-5">
                <x-input-label for="email" class="text-white/90 font-semibold" value="Email" />
                <x-text-input id="email" type="email" name="email"
                    class="block mt-1 w-full bg-white/70 rounded-xl border-0 
                           focus:ring-2 focus:ring-green-400 text-gray-900"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-200 text-sm" />
            </div>

            <!-- Password -->
            <div class="mb-5">
                <x-input-label for="password" class="text-white/90 font-semibold" value="Password" />
                <x-text-input id="password" type="password" name="password"
                    class="block mt-1 w-full bg-white/70 rounded-xl border-0 
                           focus:ring-2 focus:ring-green-400 text-gray-900"
                    required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-200 text-sm" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-8">
                <x-input-label for="password_confirmation" class="text-white/90 font-semibold" value="Konfirmasi Password" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                    class="block mt-1 w-full bg-white/70 rounded-xl border-0 
                           focus:ring-2 focus:ring-green-400 text-gray-900"
                    required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-200 text-sm" />
            </div>

            <!-- Submit -->
            <button
                class="w-full bg-green-600 hover:bg-green-700
                       text-white font-bold py-3 rounded-xl
                       shadow-lg transition duration-200">
                Daftar
            </button>

            <p class="text-center text-sm text-white mt-6 drop-shadow">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-green-300 hover:underline">
                    Masuk di sini
                </a>
            </p>
        </form>

    </div>
</x-guest-layout>
