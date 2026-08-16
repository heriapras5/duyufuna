<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $users = User::when($search, fn($q) => $q->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"))
            ->orderByDesc('is_admin')->latest()->paginate(25)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403);
        }
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,super_admin',
        ]);

        if ($validated['role'] === 'super_admin' && User::superAdminExists()) {
            return back()->withInput()->with('error', 'Super Admin sudah ada. Hanya satu akun Super Admin yang diizinkan.');
        }

        $validated['password'] = bcrypt($validated['password']);
        $validated['is_admin'] = true;

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403);
        }
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'nullable|in:admin,super_admin',
        ]);

        if ($user->isSuperAdmin() && !auth()->user()->isSuperAdmin()) {
            return back()->with('error', 'Anda tidak memiliki izin untuk mengubah Super Admin.');
        }

        if ($user->isSuperAdmin()) {
            unset($validated['role']);
        } elseif (($validated['role'] ?? '') === 'super_admin' && User::superAdminExists()) {
            return back()->withInput()->with('error', 'Super Admin sudah ada. Hanya satu akun Super Admin yang diizinkan.');
        }

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        if ($user->isSuperAdmin()) {
            return back()->with('error', 'Super Admin tidak dapat dihapus.');
        }

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun Anda sendiri.');
        }

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
