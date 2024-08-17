<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Task_Categories;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Task::factory()->count(15)->create();
        Category::factory()->count(20)->create();
        Task_Categories::factory()->count(25)->create();
    }
}
