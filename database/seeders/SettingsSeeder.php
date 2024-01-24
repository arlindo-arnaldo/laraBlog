<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(['name' => 'larablog']);
        DB::table('blog_social_media')->insert(['bsm_facebok' => 'facebook.com']);
    }
}