<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Default Admin User
        DB::table('users')->insert(
            [
                'name' => 'Admin',
                'email' => 'admin123@gmail.com',
                'password' => Hash::make('Admin123'),
                'profile' => 'profile_admin.jpg',
                'type' => '0',
                'phone' => '09123456789',
                'address' => 'No.(112/114), Botadaung Pagoda Road',
                'dob' => '1999-9-9',
                'created_user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
    }
}
