<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('settings.index', [
            'background_image' => Setting::get('background_image', 'bg-default.jpg'),
            'logo' => Setting::get('logo', 'logo-default.png'),
            'navigation' => json_decode(Setting::get('navigation', json_encode([
                ['route' => 'dashboard', 'title' => 'Dashboard', 'icon' => 'fas fa-home'],
                ['route' => 'users.index', 'title' => 'Master Pengguna', 'icon' => 'fas fa-users'],
                ['route' => 'settings.index', 'title' => 'Pengaturan', 'icon' => 'fas fa-cog'],
                ['route' => 'logout', 'title' => 'Logout', 'icon' => 'fas fa-sign-out-alt']
            ])), true),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'navigation' => 'nullable|json',
        ]);
        
        // dd($request->all());
        if ($request->hasFile('background_image')) {
            $bgPath = $request->file('background_image')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'background_image'], ['value' => $bgPath]);
        }

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'logo'], ['value' => $logoPath]);
        }

        Setting::updateOrCreate(['key' => 'navigation'], ['value' => $request->navigation]);

        return redirect()->route('settings.index')->with('success', 'Pengaturan diperbarui.');
    }

    public function reset()
    {
        Setting::whereIn('key', ['background_image', 'logo', 'navigation'])->delete();

        $defaultNavigation = [
            [
                'title' => 'Dashboard',
                'route' => 'dashboard',
                'icon' => 'fas fa-home'
            ],
            [
                'title' => 'Master Pengguna',
                'route' => 'users.index',
                'icon' => 'fas fa-users'
            ],
            [
                'title' => 'Pengaturan',
                'route' => 'settings.index',
                'icon' => 'fas fa-cog'
            ],
            [
                'title' => 'Logout',
                'route' => 'logout',
                'icon' => 'fas fa-sign-out-alt'
            ]
        ];

        Setting::updateOrCreate(
            ['key' => 'navigation'],
            ['value' => json_encode($defaultNavigation)]
        );

        return redirect()->route('settings.index')->with('success', 'Pengaturan telah dikembalikan ke default.');
    }

}
