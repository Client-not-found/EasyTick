<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    DB::table('users')->insert([
            [
                'groId' => '1',
                'username' => 'admin',
                'password' => Hash::make('admin'),

                'firstname' => 'Max',
                'lastname' => 'Mustermann',

                'street' => 'Musterstrasse 1',
                'zip' => '4057',
                'city' => 'Basel',
                'state' => 'Switzerland',

                'mail' => 'admin@test.ch',
            ],

        ]);
    }
}
