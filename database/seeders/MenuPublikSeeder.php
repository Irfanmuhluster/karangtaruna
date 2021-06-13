<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuPublikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $menu =
            [
                [
                    'name' => 'Menu Utama',
                ],
                [
                    'name' => 'Menu Bawah',
                ],
            ];

        \DB::table('public_menus')->insert($menu);

        $menu_items =
        [
            [
                'label' => 'Beranda',
                'link' => '/beranda',
                'parent' => 0,
                'sort' => 1,
                'class' => null,
                'menu' => 1,
                'depth' => 0,
            ],
        ];
        \DB::table('public_menu_items')->insert($menu_items);
    }
}
