<x-app-layout>
 <div class="p-6 bg-white shadow rounded-lg">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-xl text-green-700 dark:text-gray-700 leading-tight">
                {{ __('Manajemen Kelola Pengguna') }}
            </h2>
            <button 
                onclick="history.back()" 
                class="py-2 px-4 bg-green-700 text-white rounded-lg text-sm font-medium hover:bg-green-800">
                Kembali
            </button>
        </div>
        <div class="w-26 h-1 bg-green-700 rounded-full mt-2"></div>
        <div class="py-4">
        <!-- Tabel -->
         <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status Penulis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-green-300">
                    @foreach ($users as $user)
                    <tr class="hover:bg-green-100/40">
                        <td class="px-6 py-4 text-gray-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-gray-900">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-blue-700 font-medium">{{ $user->role }}</td>
                        <td class="px-6 py-4 text-gray-900">{{ $user->penulis_status }}</td>
                        <td class="px-6 py-4 flex gap-2">
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
