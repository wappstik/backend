<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Pack;
use App\Models\Sticker;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        
        User::factory(10)->create();
        Category::factory(5)->create();
        Pack::factory(5)->create();
        Sticker::factory(30)->create();
    }
}
