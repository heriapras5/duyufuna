<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $faqs = FAQ::when($search, fn($q) => $q->where('question', 'like', "%{$search}%"))
            ->orderBy('sort')->paginate(25)->withQueryString();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'boolean',
        ]);

        $validated['sort'] ??= FAQ::max('sort') + 1;

        FAQ::create($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit(FAQ $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, FAQ $faq)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'boolean',
        ]);

        $validated['sort'] ??= FAQ::max('sort') + 1;

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(FAQ $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil dihapus.');
    }
}
