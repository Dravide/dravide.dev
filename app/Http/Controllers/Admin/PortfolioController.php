<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::ordered()->get();
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolio.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'category' => 'nullable|string|max:255',
            'project_url' => 'nullable|url|max:255',
            'source_url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer',
            'is_visible' => 'boolean',
        ]);

        $validated['is_visible'] = $request->has('is_visible');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('portfolios', 'public');
        }

        Portfolio::create($validated);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio item created successfully.');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'category' => 'nullable|string|max:255',
            'project_url' => 'nullable|url|max:255',
            'source_url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer',
            'is_visible' => 'boolean',
        ]);

        $validated['is_visible'] = $request->has('is_visible');

        if ($request->hasFile('image')) {
            if ($portfolio->image) {
                Storage::disk('public')->delete($portfolio->image);
            }
            $validated['image'] = $request->file('image')->store('portfolios', 'public');
        }

        $portfolio->update($validated);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio item updated successfully.');
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->image) {
            Storage::disk('public')->delete($portfolio->image);
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio item deleted successfully.');
    }
}
