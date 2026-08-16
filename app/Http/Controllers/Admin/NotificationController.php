<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = Notification::latest()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->search . '%')
                        ->orWhere('body', 'like', '%' . $request->search . '%');
                });
            })
            ->paginate(20);

        return view('admin.notifications.index', compact('notifications'));
    }

    public function edit(Notification $notification)
    {
        return view('admin.notifications.edit', compact('notification'));
    }

    public function update(Request $request, Notification $notification)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'url' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = app(ImageService::class)->processAndStore($request->file('image'), 'notifications', 600);
            if ($notification->image) Storage::disk('public')->delete($notification->image);
        } elseif ($request->input('remove_image')) {
            if ($notification->image) Storage::disk('public')->delete($notification->image);
            $validated['image'] = null;
        }

        $notification->update($validated);

        return redirect()->route('admin.notifications.index')->with('success', 'Notifikasi berhasil diperbarui.');
    }

    public function destroy(Notification $notification)
    {
        if ($notification->image) Storage::disk('public')->delete($notification->image);
        $notification->delete();

        return redirect()->route('admin.notifications.index')->with('success', 'Notifikasi berhasil dihapus.');
    }
}
