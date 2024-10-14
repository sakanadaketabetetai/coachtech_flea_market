<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'レディース'],
            ['name' => 'メンズ'],
            ['name' => 'キッズ・ベビー'],
            ['name' => 'スマートフォン・携帯電話'],
            ['name' => 'パソコン・タブレット'],
            ['name' => '本'],
            ['name' => 'フィギュア'],
            ['name' => '家具'],
            ['name' => 'スキンケア'],
            ['name' => 'スポーツ用品'],
            ['name' => '自動車パーツ'],
            ['name' => 'お菓子'],
            ['name' => 'ペット用品'],
            ['name' => 'その他'],
        ]);
        
    }
}
