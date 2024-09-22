<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'full_name' => 'Julian Amado',
            'email' => 'J.amadosena@gmail.com',
            'password' => Hash::make('1013108026'),
        ]);

        User::create([
            'full_name' => 'Tony Mendez',
            'email' => 'J.mendezsena@gmail.com',
            'password' => Hash::make('1013109028'),
        ]);

        User::factory(10)->create();

    }
}
