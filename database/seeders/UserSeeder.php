<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Kesiswaan',
            'email' => 'kesiswaan@gmail.com',
            'password' => Hash::make('kesiswaan@2022'),
        ]);
    }
}
