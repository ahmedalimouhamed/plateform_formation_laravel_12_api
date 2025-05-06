<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    private $users = [
        [
            'name' => 'admin1',
            'email' => 'admin1@admin.com',
            'password' => 'password',
        ],
        [
            'name' => 'admin2',
            'email' => 'admin2@admin.com',
            'password' => 'password',
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);
        }
    }
}
