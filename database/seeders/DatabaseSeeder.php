<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //deleteDirectory
        Storage::deleteDirectory('articles');
        Storage::deleteDirectory('categories');

        //makeDirectory
        Storage::makeDirectory('articles');
        Storage::makeDirectory('categories');

        //Seeder calling
        $this->call(UserSeeder::class);

        //Factories
        Category::factory(8)->create();
        Article::factory(20)->create();
        Comment::factory(20)->create();
    }
}
