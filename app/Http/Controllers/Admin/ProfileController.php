<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('admin.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'required_with:new_password|string',
            'new_password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Password saat ini tidak sesuai.');
            }
            $validated['password'] = Hash::make($request->new_password);
        }

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = app(ImageService::class)->processAndStore($request->file('avatar'), 'avatars', 512);
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
        } elseif ($request->boolean('remove_avatar')) {
            $validated['avatar'] = null;
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
        }

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
