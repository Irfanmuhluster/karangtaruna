<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $items =
        [
            [
                'title' => 'Informasi',
                'slug' => 'informasi',
            ],
            [
                'title' => 'Kegiatan',
                'slug' => 'kegiatan',
            ],

        ];

        \DB::table('news_category')->insert($items);
    }
}
