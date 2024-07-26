<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'nguyenleduydang@gmail.com',
            'password' => Hash::make('123'), // Mã hóa mật khẩu
            'role' => 1, // Gán vai trò admin (1)
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'dang123@gmail.com',
            'password' => Hash::make('123'), // Mã hóa mật khẩu
            'role' => 0, // Gán vai trò người dùng (0)
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

