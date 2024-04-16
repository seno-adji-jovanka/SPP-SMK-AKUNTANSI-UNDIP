<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.z
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminspp'),
            // 'level' => 'admin',
        ]);

        // \App\Models\User::create([
        //     'name' => 'Petugas',
        //     'username' => 'petugas',
        //     'email' => 'petugas@gmail.com',
        //     'password' => Hash::make('indonesia'),
        //     'level' => 'petugas',
        // ]);
    }
}