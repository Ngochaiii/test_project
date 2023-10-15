<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
                'role' => '1',
            ]
        ]);
        for ($i = 2; $i <= 5; $i++) {
            DB::table('users')->insert([
                [
                    'name' => 'User' . $i,
                    'email' => $i . 'user@gmail.com',
                    'password' => bcrypt('admin123'),
                    'role' => '0',
                ]
            ]);
        }
    }
}
