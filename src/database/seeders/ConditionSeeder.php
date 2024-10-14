<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conditions')->insert([
            ['condition' => '新品/未使用'],
            ['condition' => '未使用に近い'],
            ['condition' => '目立った傷や汚れなし'],
            ['condition' => '屋や傷や汚れあり'],
            ['condition' => '傷や汚れあり'],
            ['condition' => 'ジャンク品'],
        ]);
    }
}
