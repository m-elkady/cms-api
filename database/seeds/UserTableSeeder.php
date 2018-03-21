<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username'   => 'admin',
            'email'      => 'admin@test.com',
            'password'   => bcrypt('123456'),
            'created_at' => Factory::create()->dateTime('now'),
            'updated_at' => Factory::create()->dateTime('now'),
        ]);
    }
}
