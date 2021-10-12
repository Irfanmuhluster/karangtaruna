<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $this->generateFor('user', 'web', 'pengguna');
        $this->generateFor('role', 'web',  'peran');

        /* halaman */
        $this->generateFor('page', 'web', 'Halaman');

        /* gallery */
        $this->generateFor('gallery', 'web', 'Gallery');

        /* gallery */
        $this->generateFor('gallerycategory', 'web', 'Kategori Gallery');

        /* banner */
        $this->generateFor('banner', 'web', 'Banner');

        /* newsletter */
        $this->generateFor('newsletter', 'web', 'Newsletter');

        /* Anggota News Letter */
        Permission::create(['name' => 'read_newsletter_anggota', 'guard_name'=> 'web', 'menu_name' => 'Anggota newsletter']);
        Permission::create(['name' => 'delete_newsletter_anggota', 'guard_name'=> 'web', 'menu_name' => 'Anggota newsletter']);

        /* agenda */
        $this->generateFor('agenda', 'web', 'Agenda');

        Permission::create(['name' => 'edit_permission', 'guard_name'=> 'web', 'menu_name' => 'hak akses']);
        Permission::create(['name' => 'read_permission', 'guard_name'=> 'web', 'menu_name' => 'hak akses']);
        Permission::create(['name' => 'create_menu_admin', 'guard_name'=> 'web', 'menu_name' => 'hak akses']);
        Permission::create(['name' => 'edit_menu_admin', 'guard_name'=> 'web', 'menu_name' => 'hak akses']);
        Permission::create(['name' => 'delete_menu_admin', 'guard_name'=> 'web', 'menu_name' => 'hak akses']);

        /* contact */
        Permission::create(['name' => 'read_all_contact_us', 'guard_name'=> 'web', 'menu_name' => 'Kontak kami']);
        Permission::create(['name' => 'read_reply_contact', 'guard_name'=> 'web', 'menu_name' => 'Kontak kami']);
        Permission::create(['name' => 'read_reply_unreaply', 'guard_name'=> 'web', 'menu_name' => 'Kontak kami']);
        Permission::create(['name' => 'delete_contact_us', 'guard_name'=> 'web', 'menu_name' => 'Kontak kami']);

        Permission::create(['name' => 'kelola_menu', 'guard_name'=> 'web', 'menu_name' => 'menu publik']);

        Permission::create(['name' => 'ubah password', 'guard_name'=> 'web', 'menu_name' => 'pengguna']);

        /*news*/
        Permission::create(['name' => 'edit_news', 'guard_name'=> 'web', 'menu_name' => 'berita']);
        Permission::create(['name' => 'read_news', 'guard_name'=> 'web', 'menu_name' => 'berita']);
        Permission::create(['name' => 'create_news', 'guard_name'=> 'web', 'menu_name' => 'berita']);
        Permission::create(['name' => 'delete_news', 'guard_name'=> 'web', 'menu_name' => 'berita']);

        Permission::create(['name' => 'edit_newscategory', 'guard_name'=> 'web', 'menu_name' => 'kategori berita']);
        Permission::create(['name' => 'read_newscategory', 'guard_name'=> 'web', 'menu_name' => 'kategori berita']);
        Permission::create(['name' => 'create_newscategory', 'guard_name'=> 'web', 'menu_name' => 'kategori berita']);
        Permission::create(['name' => 'delete_newscategory', 'guard_name'=> 'web', 'menu_name' => 'kategori berita']);

    }

    public function generateFor($name, $guard,  $menu_name)
    {
        Permission::create(['name' => 'read_'.$name, 'guard_name'=> $guard, 'menu_name' => $menu_name]);
        Permission::create(['name' => 'create_'.$name, 'guard_name'=> $guard, 'menu_name' => $menu_name]);
        Permission::create(['name' => 'edit_'.$name, 'guard_name'=> $guard, 'menu_name' => $menu_name]);
        Permission::create(['name' => 'delete_'.$name, 'guard_name'=> $guard, 'menu_name' => $menu_name]);
    }
}
