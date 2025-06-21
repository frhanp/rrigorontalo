<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate(['role' => 'required|in:admin,editor']);

        // Mencegah admin mengubah role-nya sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat mengubah role untuk akun Anda sendiri.');
        }

        $user->update(['role' => $request->role]);

        return back()->with('success', "Role untuk user {$user->name} berhasil diperbarui.");
    }
}
