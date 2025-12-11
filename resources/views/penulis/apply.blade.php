<x-app-layout>
    <div class="max-w-3xl mx-auto py-10">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Ajukan Menjadi Penulis</h2>

            @if(session('success'))
                <div class="mb-4 text-green-700">{{ session('success') }}</div>
            @endif

            <form action="{{ route('penulis.apply.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Deskripsi singkat (bio)</label>
                    <textarea name="penulis_bio" rows="6"
                        class="w-full rounded border p-2"
                        required>{{ old('penulis_bio', auth()->user()->penulis_bio) }}</textarea>
                    @error('penulis_bio') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Link contoh karya (opsional)</label>
                    <input type="url" name="penulis_sample" value="{{ old('penulis_sample', auth()->user()->penulis_sample) }}"
                        class="w-full rounded border p-2" placeholder="https://...">
                    @error('penulis_sample') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>
                @if (session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                 {{ session('success') }}
</div>
@endif

                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Kirim Pengajuan</button>
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-200 rounded">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

