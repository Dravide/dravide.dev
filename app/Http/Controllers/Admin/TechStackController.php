<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TechStack;
use Illuminate\Http\Request;

class TechStackController extends Controller
{
    public function index()
    {
        $techStacks = TechStack::ordered()->get();
        return view('admin.tech-stack.index', compact('techStacks'));
    }

    public function create()
    {
        return view('admin.tech-stack.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
            'sort_order' => 'required|integer',
            'is_visible' => 'boolean',
        ]);

        if (!isset($validated['is_visible'])) {
            $validated['is_visible'] = false;
        }

        TechStack::create($validated);

        return redirect()->route('admin.tech-stack.index')
            ->with('success', 'Tech stack item created successfully.');
    }

    public function edit(TechStack $techStack)
    {
        return view('admin.tech-stack.edit', compact('techStack'));
    }

    public function update(Request $request, TechStack $techStack)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
            'sort_order' => 'required|integer',
            'is_visible' => 'boolean',
        ]);

        if (!isset($validated['is_visible'])) {
            $validated['is_visible'] = false;
        }

        $techStack->update($validated);

        return redirect()->route('admin.tech-stack.index')
            ->with('success', 'Tech stack item updated successfully.');
    }

    public function destroy(TechStack $techStack)
    {
        $techStack->delete();

        return redirect()->route('admin.tech-stack.index')
            ->with('success', 'Tech stack item deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $index => $id) {
            TechStack::where('id', $id)->update(['sort_order' => $index]);
        }
        return response()->json(['success' => true]);
    }
}
