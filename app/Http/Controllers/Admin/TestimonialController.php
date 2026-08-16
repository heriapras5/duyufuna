<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $testimonials = Testimonial::when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->latest()->paginate(25)->withQueryString();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'nullable|boolean',
        ]);

        $validated['status'] = $request->boolean('status');

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'nullable|boolean',
        ]);

        $validated['status'] = $request->boolean('status');

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
