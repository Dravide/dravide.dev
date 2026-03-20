<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Profile;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $profile = Profile::first();
        $portfolioCount = Portfolio::count();

        return view('admin.dashboard', compact('profile', 'portfolioCount'));
    }
}
