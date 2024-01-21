<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AuthorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'name' => 'Admin/Super Author'
        ]);
        DB::table('types')->insert([
            'name' => 'author'
        ]);
    }
}
