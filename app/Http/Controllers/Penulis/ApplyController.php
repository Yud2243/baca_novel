<?php

namespace App\Http\Controllers\Penulis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    public function create()
    {
        return view('penulis.apply');
    }

    public function store(Request $request)
    {
        $request->validate([
            'penulis_bio' => 'required|string|max:2000',
            'penulis_sample' => 'nullable|url|max:1000',
        ]);

        $user = auth()->user();

        // update data pengajuan
        $user->update([
            'penulis_bio' => $request->penulis_bio,
            'penulis_sample' => $request->penulis_sample,
            'penulis_status' => 'pending',
            'penulis_note' => null,
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengajuan penulis dikirim. Tunggu persetujuan admin.');
    }
}
