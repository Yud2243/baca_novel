<x-app-layout>
    <div class="max-w-6xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Permohonan Penulis</h1>

        @if(session('success'))
            <div class="mb-4 text-green-700">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded shadow p-4">
            <table class="w-full text-left">
                <thead>
                    <tr>
                        <th class="py-2">#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Bio</th>
                        <th>Sample</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\User::where('penulis_status','pending')->get() as $u)
                        <tr class="border-t">
                            <td class="py-2">{{ $loop->iteration }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td style="max-width:300px;">{{ Str::limit($u->penulis_bio, 180) }}</td>
                            <td>
                                @if($u->penulis_sample)
                                    <a href="{{ $u->penulis_sample }}" target="_blank" class="text-blue-600">Lihat</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $u->penulis_status }}</td>
                            <td class="text-right">
                                <form action="{{ route('admin.users.approve', $u->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button class="px-3 py-1 bg-green-600 text-white rounded">Approve</button>
                                </form>

                                <button onclick="document.getElementById('reject-{{ $u->id }}').classList.toggle('hidden')"
                                        class="px-3 py-1 bg-red-500 text-white rounded ml-2">
                                    Reject
                                </button>

                                <form id="reject-{{ $u->id }}" action="{{ route('admin.users.reject', $u->id) }}" method="POST"
                                      class="hidden mt-2">
                                    @csrf
                                    <textarea name="note" placeholder="Alasan penolakan" class="w-full rounded border p-2"></textarea>
                                    <div class="mt-2">
                                        <button class="px-3 py-1 bg-gray-700 text-white rounded">Kirim Penolakan</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
