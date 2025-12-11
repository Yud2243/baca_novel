<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PenulisController extends Controller
{
    public function listApplicants()
    {
        $applicants = User::where('penulis_status', 'pending')->get();
        return view('admin.penulis.applicants', compact('applicants'));
    }

    
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->penulis_status = 'approved';
        $user->role = 'penulis';
        $user->save();

        return back()->with('success', 'User disetujui sebagai penulis.');
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->penulis_status = 'rejected';
        $user->save();

        return back()->with('success', 'Pengajuan ditolak.');
    }
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
    ]);

    Book::create([
        'title' => $request->title,
        'user_id' => auth()->id(),
        'status' => 'pending'
    ]);

    return back()->with('success', 'Buku berhasil diajukan! Menunggu persetujuan admin.');
}

}
