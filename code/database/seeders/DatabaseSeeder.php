<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' =>'admin',
            'email' => 'admintest@yopmail.com',
            'password' => bcrypt('password'),
        ]);

        $this->call(ProductSeeder::class);
    }
}
