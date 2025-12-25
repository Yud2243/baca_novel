<x-app-layout>
    {{-- TENTANG KAMI --}}
    <div class="p-6 md:p-10 text-gray-800">

        {{-- Judul --}}
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-extrabold text-green-800">
                Tentang Kami
            </h2>
            <div class="w-24 h-1 bg-green-600 rounded-full mx-auto mt-3"></div>
        </div>

        {{-- Konten --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

            {{-- Teks --}}
            <div class="space-y-4 leading-relaxed text-gray-700">
                <p>
                    <span class="font-semibold text-green-700">BacaBuku</span> adalah
                    platform membaca dan menulis novel digital yang dibuat untuk
                    mempertemukan <strong>pembaca</strong> dan <strong>penulis</strong>
                    dalam satu ekosistem yang nyaman dan mudah digunakan.
                </p>

                <p>
                    Kami percaya bahwa setiap orang memiliki cerita yang layak untuk
                    dibagikan. Oleh karena itu, kami menyediakan fitur bagi pengguna
                    untuk mengajukan diri sebagai penulis dan mempublikasikan karya
                    mereka secara langsung.
                </p>

                <p>
                    Dengan tampilan yang sederhana, nyaman di mata, dan fokus pada
                    pengalaman membaca, kami berharap BacaBuku menjadi rumah bagi
                    cerita-cerita terbaik.
                </p>
            </div>

            {{-- Highlight / Value --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div class="bg-green-50 border border-green-100 rounded-xl p-5 text-center">
                    <h3 class="text-xl font-bold text-green-700">📚 Mudah Dibaca</h3>
                    <p class="text-sm text-gray-600 mt-2">
                        Tampilan bersih dan nyaman untuk membaca dalam waktu lama.
                    </p>
                </div>

                <div class="bg-green-50 border border-green-100 rounded-xl p-5 text-center">
                    <h3 class="text-xl font-bold text-green-700">✍️ Untuk Penulis</h3>
                    <p class="text-sm text-gray-600 mt-2">
                        Penulis dapat mengelola buku dan chapter dengan mudah.
                    </p>
                </div>

                <div class="bg-green-50 border border-green-100 rounded-xl p-5 text-center">
                    <h3 class="text-xl font-bold text-green-700">🔒 Terverifikasi</h3>
                    <p class="text-sm text-gray-600 mt-2">
                        Karya penulis melalui proses validasi admin.
                    </p>
                </div>

                <div class="bg-green-50 border border-green-100 rounded-xl p-5 text-center">
                    <h3 class="text-xl font-bold text-green-700">🌱 Berkembang</h3>
                    <p class="text-sm text-gray-600 mt-2">
                        Platform terus dikembangkan sesuai kebutuhan pengguna.
                    </p>
                </div>

            </div>
        </div>

    </div>
</div>

</x-app-layout>
