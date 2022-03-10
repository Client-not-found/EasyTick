<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            [
                'name' => 'Login',
                'status' => true,
            ],
            [
                'name' => 'knowledgebase',
                'status' => true,
            ],
        ]);
    }
}
