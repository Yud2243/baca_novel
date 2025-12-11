@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Banner / Cover -->
    <div class="mb-8">
        <div class="w-full h-64 bg-gray-300 flex items-center justify-center text-gray-700 text-2xl rounded-lg shadow">
            Banner / Cover Novel Unggulan
        </div>
    </div>

    <!-- Rekomendasi Section -->
    <h2 class="text-green-600 font-bold text-xl mb-4">Rekomendasi Novel</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="w-full h-40 bg-gray-300 flex items-center justify-center text-gray-500">
                Cover Novel
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-lg">Judul Novel 1</h3>
                <p class="text-gray-500 text-sm mb-2">Oleh: Penulis A</p>
                <p class="text-gray-700 text-sm leading-relaxed">
                    Sinopsis ringkas atau rangkuman singkat yang padat dan menarik dari cerita ini...
                </p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="w-full h-40 bg-gray-300 flex items-center justify-center text-gray-500">
                Cover Novel
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-lg">Judul Novel 2</h3>
                <p class="text-gray-500 text-sm mb-2">Oleh: Penulis B</p>
                <p class="text-gray-700 text-sm leading-relaxed">
                    Sinopsis ringkas atau rangkuman singkat yang padat dan menarik dari cerita ini...
                </p>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="w-full h-40 bg-gray-300 flex items-center justify-center text-gray-500">
                Cover Novel
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-lg">Judul Novel 3</h3>
                <p class="text-gray-500 text-sm mb-2">Oleh: Penulis C</p>
                <p class="text-gray-700 text-sm leading-relaxed">
                    Sinopsis ringkas atau rangkuman singkat yang padat dan menarik dari cerita ini...
                </p>
            </div>
        </div>
    </div>
@endsection
