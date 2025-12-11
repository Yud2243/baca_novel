<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-green-700 dark:text-green-300 leading-tight">
                {{ __('Novel Saya') }}
            </h2>

            <div class="flex gap-2 items-center">
                <a href="{{ route('penulis.dashboard') }}"  
                   class="py-2 px-4 bg-green-700 text-white rounded-lg text-sm font-medium 
                          hover:bg-green-800 dark:bg-green-600 dark:hover:bg-green-500">
                    Kembali
                </a>

                <a href="{{ route('penulis.books.create') }}" 
                   class="py-2 px-4 bg-green-600 text-white rounded-lg text-sm font-medium 
                          hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-400">
                    Tambah Buku Baru
                </a>
            </div>
        </div>

        <div class="h-1 bg-green-700 rounded-full mt-3"></div>
    </x-slot>


    <div class="max-w-6xl mx-auto px-4 py-6">

        @if($books->count() > 0)

            <!-- GRID -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                @foreach($books as $book)
                    <div onclick="openModal({{ $book->id }})"
                        class="cursor-pointer bg-white shadow-lg rounded-xl p-4 border border-gray-100 
                               hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">

                        <!-- Thumbnail Cover -->
                        <div class="h-40 w-full bg-green-200 rounded-lg mb-3 flex items-center justify-center text-green-700 font-semibold">
                            Cover
                        </div>

                        <h3 class="font-bold text-lg text-green-800 line-clamp-1">
                            {{ $book->title }}
                        </h3>

                        <p class="text-sm text-gray-600 mt-1">
                            <span class="font-semibold">Penulis:</span> {{ Auth::user()->name }}
                        </p>

                        <p class="text-sm text-gray-600 mt-1 line-clamp-2">
                            {{ $book->description }}
                        </p>

                        <span class="inline-block mt-2 bg-green-100 text-green-700 px-3 py-1 text-xs rounded-lg">
                            {{ ucfirst($book->status) }}
                        </span>
                    </div>

                    <!-- MODAL POPUP DETAIL -->
                    <div id="modal-{{ $book->id }}" 
                         class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

                        <div class="bg-white rounded-xl shadow-xl w-11/12 max-w-lg p-6 relative">

                            <!-- Close Button -->
                            <button onclick="closeModal({{ $book->id }})"
                                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-2xl">
                                &times;
                            </button>

                            <h2 class="text-2xl font-bold text-green-700 mb-2">
                                {{ $book->title }}
                            </h2>

                            <p class="text-gray-700 mb-1">
                                <strong>Penulis:</strong> {{ Auth::user()->name }}
                            </p>

                            <p class="text-gray-700 mb-1">
                                <strong>Status:</strong> 
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded-lg text-sm">
                                    {{ ucfirst($book->status) }}
                                </span>
                            </p>

                            <p class="text-gray-700 mt-3">
                                <strong>Deskripsi:</strong><br>
                                {{ $book->description }}
                            </p>

                            <div class="mt-6 flex justify-end gap-3">

                                <a href="{{ route('penulis.books.edit', $book) }}"
                                   class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                                    Edit
                                </a>

                                <form action="{{ route('penulis.books.destroy', $book) }}" 
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
                                            onclick="return confirm('Yakin hapus buku ini?')">
                                        Hapus
                                    </button>
                                </form>

                            </div>

                        </div>
                    </div>
                @endforeach

            </div>

        @else
            <p class="text-muted mt-3">Belum ada buku.</p>
        @endif
    </div>



    <!-- SCRIPT MODAL -->
    <script>
        function openModal(id) {
            document.getElementById('modal-' + id).classList.remove('hidden');
        }
        function closeModal(id) {
            document.getElementById('modal-' + id).classList.add('hidden');
        }
    </script>

</x-app-layout>
