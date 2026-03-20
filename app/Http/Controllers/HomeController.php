<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Portfolio;
use App\Models\TechStack;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $portfolios = Portfolio::visible()->ordered()->with('techStacks')->get();
        $techStacks = TechStack::visible()->ordered()->get();
        $blogPosts = BlogPost::where('is_published', true)->latest()->get();

        return view('home', compact('profile', 'portfolios', 'techStacks', 'blogPosts'));
    }
}
