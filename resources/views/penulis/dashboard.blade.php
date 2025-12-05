<x-app-layout>
    <h1>Dashboard Penulis</h1>
    <p>Selamat datang, {{ auth()->user()->name }}!</p>

    {{-- Section Panel CRUD Novel --}}
    @if(auth()->user()->isPenulis())
        <section class="mt-6">
            <h2>Panel Buku Saya</h2>
            <div class="flex gap-4 mt-2">
                <a href="{{ route('penulis.books.index') }}" class="btn btn-primary">
                    Lihat Buku Saya
                </a>
                <a href="{{ route('penulis.books.create') }}" class="btn btn-success">
                    Tambah Buku Baru
                </a>
            </div>
        </section>
    @else
        <p class="mt-4 text-red-600">
            Anda belum menjadi penulis. <a href="#" class="underline">Daftar jadi penulis</a>
        </p>
    @endif
</x-app-layout>
