<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeaderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('header')->insertGetId([
            'id'=>0,
            'title'=>'title',
            'instagram'=>'instagram',
            'youtube'=>'youtube',
            'web'=>'web',
            'logo'=>'logo',
            'advertisement'=>'reklam',
        ]);
    }
}
