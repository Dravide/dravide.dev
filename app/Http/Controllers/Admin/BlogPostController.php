<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = \App\Models\BlogPost::latest()->get();
        return view('admin.blog-post.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog-post.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_posts',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blog', 'public');
        }

        if (!isset($validated['is_published'])) {
            $validated['is_published'] = false;
        }

        \App\Models\BlogPost::create($validated);

        return redirect()->route('admin.blog-posts.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(\App\Models\BlogPost $blogPost)
    {
        return view('admin.blog-post.edit', compact('blogPost'));
    }

    public function update(Request $request, \App\Models\BlogPost $blogPost)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_posts,slug,' . $blogPost->id,
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            if ($blogPost->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($blogPost->image);
            }
            $validated['image'] = $request->file('image')->store('blog', 'public');
        }

        if (!isset($validated['is_published'])) {
            $validated['is_published'] = false;
        }

        $blogPost->update($validated);

        return redirect()->route('admin.blog-posts.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(\App\Models\BlogPost $blogPost)
    {
        if ($blogPost->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($blogPost->image);
        }
        $blogPost->delete();

        return redirect()->route('admin.blog-posts.index')
            ->with('success', 'Blog post deleted successfully.');
    }
}
