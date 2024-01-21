<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'Arlindo',
                'username' => 'arlindodev',
                'email' => 'arlindo@gmail.com',
                'password' => '$2y$10$md8OKXef5JdYETZ2zl1rhu6df82xdiMGfZcG7Vg2WKvN2AoEx4kRy',
                'biography' => 'Esta é a minha biografia',
                'type' => 1,
                'blocked' => 0,
                'direct_publish' => 1
            ]
        );
    }
}
