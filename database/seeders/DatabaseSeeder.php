<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use illuminate\Support\rand;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
          'name'=>'admin',
          'type'=>'Admin',
          'email' =>'admin@gmail.com',
          'password'=>Hash::make('password'),
          'email_verified_at'=>now(),
          'remember_token' => rand(0,10000000000),
          'created_at'=>now(),

        ]);
    }
}
