<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FooterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('footer')->insertGetId([
            'id'=>0,
            'explanation'=>'explanation',
            'instagram'=>'instagram',
            'youtube'=>'youtube',
            'web'=>'web',
        ]);
    }
}
