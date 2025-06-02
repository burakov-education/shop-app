<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        DB::table('users')->insertOrIgnore([
//            'id' => 1,
//            'email' => 'admin@shop.com',
//            'password' => Hash::make('shop2015'),
//        ]);
    }
}
