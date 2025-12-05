<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller

{

   public function update(Request $request, User $user)
{
    $request->validate([
        'role' => 'required|in:user,penulis,admin',
        'penulis_status' => 'nullable|in:none,pending,approved',
    ]);

    $user->update([
        'role' => $request->role,
        'penulis_status' => $request->penulis_status,
    ]);

    return redirect()->back()->with('success', 'User updated successfully');
}
public function index()
{
    // show all users OR show only pending depending on your UI
    return view('admin.penulis_requests');
}
public function approve(Request $request, User $user)
{
    // set role ke penulis dan status approved
    $user->update([
        'role' => 'penulis',
        'penulis_status' => 'approved',
        'penulis_note' => $request->input('note', null),
    ]);

    // Optional: kirim notifikasi / email di sini

    return redirect()->back()->with('success', 'User telah disetujui sebagai penulis.');
}

public function reject(Request $request, User $user)
{
    $request->validate(['note' => 'nullable|string|max:1000']);

    $user->update([
        // keep role as user
        'role' => 'user',
        'penulis_status' => 'rejected',
        'penulis_note' => $request->note,
    ]);

    // Optional: notifikasi ke user

    return redirect()->back()->with('success', 'Pengajuan penulis ditolak.');
}
    
}
