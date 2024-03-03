<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 管理者ユーザーを作成
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('administrator'),
            'role_id' => 10, // 管理者ユーザーのrole_id
        ]);

        // 店舗代表者ユーザーを作成
        User::create([
            'name' => 'Store Representative User',
            'email' => 'store@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('representative'),
            'role_id' => 5, // 店舗代表者ユーザーのrole_id
        ]);

        // 一般ユーザーを作成
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('RegularPass'),
            'role_id' => 1, // 一般ユーザーのrole_id
        ]);
    }
}
