<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_logo' => 'nullable|image|max:2048',
            'site_favicon' => 'nullable|image|mimes:ico,png,jpg,jpeg|max:1024',
        ]);

        if ($request->hasFile('site_logo')) {
            $oldLogo = Setting::getValue('site_logo');
            if ($oldLogo) Storage::disk('public')->delete($oldLogo);
            
            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::updateValue('site_logo', $path);
        }

        if ($request->hasFile('site_favicon')) {
            $oldFavicon = Setting::getValue('site_favicon');
            if ($oldFavicon) Storage::disk('public')->delete($oldFavicon);
            
            $path = $request->file('site_favicon')->store('settings', 'public');
            Setting::updateValue('site_favicon', $path);
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
