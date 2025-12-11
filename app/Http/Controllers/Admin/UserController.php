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
    $users = User::orderBy('id', 'DESC')->get();
    return view('admin.users.index', compact('users'));
}
public function approve(User $user)
{
    $user->update([
        'penulis_status' => 'approved',
        'role' => 'penulis',
    ]);

    return back()->with('success', 'Pengajuan penulis disetujui!');
}

public function reject(User $user)
{
    $user->update([
        'penulis_status' => 'none',
    ]);

    return back()->with('error', 'Pengajuan penulis ditolak!');
}
public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('admin.users.index')
        ->with('success', 'User berhasil dihapus!');
}



public function penulisApplicants()
{
    $users = User::where('penulis_status', 'pending')->get();
    return view('admin.users.applicants', compact('users'));
}

public function approvePenulis(User $user)
{
    $user->update([
        'penulis_status' => 'approved',
        'role' => 'penulis'
    ]);

    return back()->with('success', 'User sekarang menjadi Penulis!');
}

public function rejectPenulis(User $user)
{
    $user->update([
        'penulis_status' => 'none'
    ]);

    return back()->with('success', 'Pengajuan ditolak.');
}

    
}
