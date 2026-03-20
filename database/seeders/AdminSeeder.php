<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@dravide.dev'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );

        // Seed default projects if none exist
        if (\App\Models\Portfolio::count() == 0) {
            \App\Models\Portfolio::create([
                'title' => 'Sample Project',
                'description' => 'A sample project to demonstrate the portfolio layout.',
                'category' => 'Web Development',
                'is_visible' => true,
                'sort_order' => 1
            ]);
        }

        // Seed default tech stack if none exist
        if (\App\Models\TechStack::count() == 0) {
            $techs = [
                ['name' => 'Laravel', 'icon' => 'ti ti-brand-laravel', 'sort_order' => 1],
                ['name' => 'Tailwind', 'icon' => 'ti ti-brand-tailwind', 'sort_order' => 2],
                ['name' => 'Vite', 'icon' => 'ti ti-brand-vite', 'sort_order' => 3],
                ['name' => 'MySQL', 'icon' => 'ti ti-database', 'sort_order' => 4],
                ['name' => 'PHP', 'icon' => 'ti ti-brand-php', 'sort_order' => 5],
            ];

            foreach ($techs as $tech) {
                \App\Models\TechStack::create($tech);
            }
        }

        Profile::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Dery Supriady',
                'title' => 'Full Stack Developer',
                'bio' => 'Passionate developer crafting clean, efficient code.',
                'email' => 'hello@dravide.dev',
            ]
        );
    }
}
