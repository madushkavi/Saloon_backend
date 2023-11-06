<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'My-admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
        ]);
    }
}
