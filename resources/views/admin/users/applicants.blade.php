<x-app-layout>
    <div class="p-6 bg-white shadow rounded-lg">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-xl text-green-700 dark:text-gray-700 leading-tight">
                {{ __('Manajemen Pengajuan Penulis') }}
            </h2>
            <button 
                onclick="history.back()" 
                class="py-2 px-4 bg-green-700 text-white rounded-lg text-sm font-medium hover:bg-green-800">
                Kembali
            </button>
        </div>
        <div class="w-26 h-1 bg-green-700 rounded-full mt-2"></div>
        <div class="py-4">
        @if($users->isEmpty())
            <p class="text-gray-500">Tidak ada pengajuan penulis saat ini.</p>
        @else
        <!-- Tabel -->
        <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Bio</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Sample</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-gray-900">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-gray-900">{{ $user->penulis_bio }}</td>
                        <td class="px-6 py-4 text-gray-900">
                            <button>
                            @if($user->penulis_sample)
                                <a href="{{ $user->penulis_sample }}" target="_blank" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Lihat</a>
                            @else
                                -
                            @endif
                            </button>
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            <form action="{{ route('admin.penulis.approve', $user) }}" method="POST">
                                @csrf
                                <button class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 transition">
                                    Setuju
                                </button>
                            </form>
                            <form action="{{ route('admin.penulis.reject', $user) }}" method="POST">
                                @csrf
                                <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                    Tolak
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</x-app-layout>
