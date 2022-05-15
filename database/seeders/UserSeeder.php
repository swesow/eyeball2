<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $now = Carbon::now();

        DB::table('users')->insert([
            'id' => 1,
            'first_name' => 'Liz',
            'last_name' => 'Han', 
            'username' => 'admin',
            'user_type' => 'admin',
            'email' => 'emersonyu@gmail.com',
            'password' => Hash::make('987654321'),
            'created_at' => $now->format('Y-m-d'),
            'updated_at' => $now->format('Y-m-d')
        ]);
    }
}
