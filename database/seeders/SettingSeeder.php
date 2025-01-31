<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Setting::updateOrCreate(['key' => 'background_image'], ['value' => 'bg-default.jpg']);
        Setting::updateOrCreate(['key' => 'logo'], ['value' => 'logo-default.png']);
        Setting::updateOrCreate(['key' => 'navigation'], [
            'value' => json_encode([
                ['title' => 'Dashboard', 'icon' => 'fas fa-home', 'route' => 'dashboard'],
                ['title' => 'Users', 'icon' => 'fas fa-users', 'route' => 'users.index'],
            ])
        ]);
    }
}
