<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    public function create()
    {
        $user = auth()->user();

        if ($user->penulis_status === 'pending') {
            return redirect()->route('dashboard')
                ->with('info', 'Pengajuan sedang diproses admin.');
        }

        if ($user->penulis_status === 'approved') {
            return redirect()->route('penulis.dashboard');
        }

        return view('penulis.apply');
    }

    public function store(Request $request)
    {
        $request->validate([
            'penulis_bio' => 'required|string|max:2000',
            'penulis_sample' => 'nullable|url|max:1000',
        ]);

        $user = auth()->user();

        $user->update([
            'penulis_bio' => $request->penulis_bio,
            'penulis_sample' => $request->penulis_sample,
            'penulis_status' => 'pending',
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Pengajuan telah dikirim. Tunggu persetujuan admin.');
    }
}
