<?php

namespace Database\Seeders;

use App\Models\MenuAdmin;
use Illuminate\Database\Seeder;

class MenuAdminSeeder extends Seeder
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
                    'title' => 'Pengaturan Akses',
                    'role_id' => '1',
                    'url'  => null,
                    'icon_class' => 'fas fa-wrench',
                    'parent_id' => null,
                    'order' => '1',
                ],
                [
                    'title' => 'Pengguna',
                    'role_id' => '1',
                    'url'  => 'admin.settingaccess.user.index',
                    'icon_class' => 'far fa-circle',
                    'parent_id' => '1',
                    'order' => '1',
                ],
                [
                    'title' => 'Peran',
                    'role_id' => '1',
                    'url'  => 'admin.settingaccess.role.index',
                    'icon_class' => 'far fa-circle',
                    'parent_id' => '1',
                    'order' => '2',
                ],
                [
                    'title' => 'Hak Akses',
                    'role_id' => '1',
                    'url'  => 'admin.setting.permission',
                    'icon_class' => 'far fa-circle',
                    'parent_id' => '1',
                    'order' => '3',
                ],
                [
                    'title' => 'Pengaturan Website',
                    'role_id' => '1',
                    'url'  => null,
                    'icon_class' => 'fas fa-wrench',
                    'parent_id' => null,
                    'order' => '2',
                ],
                [
                    'title' => 'Umum',
                    'role_id' => '1',
                    'url'  => 'admin.setting.index',
                    'icon_class' => 'far fa-circle',
                    'parent_id' => '5',
                    'order' => '1',
                ],
                [
                    'title' => 'Menu Publik',
                    'role_id' => '1',
                    'url'  => 'admin.setting.menupublic.index',
                    'icon_class' => 'far fa-circle',
                    'parent_id' => '5',
                    'order' => '2',
                ],
                [
                    'title' => 'Sosial Media',
                    'role_id' => '1',
                    'url'  => 'admin.setting.sosial_media',
                    'icon_class' => 'far fa-circle',
                    'parent_id' => '5',
                    'order' => '3',
                ],
                [
                    'title' => 'Pesan Selamat Datang',
                    'role_id' => '1',
                    'url'  => 'admin.setting.welcome.index',
                    'icon_class' => 'far fa-circle',
                    'parent_id' => '5',
                    'order' => '4',
                ],
                [
                    'title' => 'Template Email',
                    'role_id' => '1',
                    'url'  => 'admin.setting.emailtemplate',
                    'icon_class' => 'far fa-circle',
                    'parent_id' => '5',
                    'order' => '6',
                ],
                [
                    'title' => 'Berita',
                    'role_id' => '1',
                    'url'  => '#',
                    'icon_class' => 'fas fa-newspaper',
                    'parent_id' => null,
                    'order' => '3',
                ],
                [
                    'title' => 'Semua Berita',
                    'role_id' => '1',
                    'url'  => 'admin.news.index',
                    'icon_class' => 'far fa-circle',
                    'parent_id' => '11',
                    'order' => '1',
                ],
                [
                    'title' => 'Kategori Berita',
                    'role_id' => '1',
                    'url'  => 'admin.newscategory.index',
                    'icon_class' => 'far fa-circle',
                    'parent_id' => '11',
                    'order' => '2',
                ],
                [
                    'title' => 'Hubungi Kami',
                    'role_id' => '1',
                    'url'  => '#',
                    'icon_class' => 'fa fa-address-book',
                    'parent_id' => null,
                    'order' => '4',
                ],
                [
                    'title' => 'Semua Pesan',
                    'role_id' => '1',
                    'url'  => 'admin.contact.index',
                    'icon_class' => 'far fa-circle',
                    'parent_id' => '14',
                    'order' => '1',
                ],
                [
                    'title' => 'Belum Dibalas',
                    'role_id' => '1',
                    'url'  => 'admin.contact.unread',
                    'icon_class' => 'far fa-circle',
                    'parent_id' => '14',
                    'order' => '2',
                ],
                [
                    'title' => 'Sudah Dibalas',
                    'role_id' => '1',
                    'url'  => 'admin.contact.read',
                    'icon_class' => 'far fa-circle',
                    'parent_id' => '14',
                    'order' => '3',
                ],
                [
                    'title' => 'Halaman',
                    'role_id' => '1',
                    'url'  => 'admin.page.index',
                    'icon_class' => 'fa fa-file-alt',
                    'parent_id' => null,
                    'order' => '5',
                ],
                [
                    'title' => 'Banner',
                    'role_id' => '1',
                    'url'  => 'admin.banner.index',
                    'icon_class' => 'fa fa-image',
                    'parent_id' => null,
                    'order' => '6',
                ],
                [
                    'title' => 'Gallery',
                    'role_id' => '1',
                    'url'  => 'admin.gallery.index',
                    'icon_class' => 'fa fa-image',
                    'parent_id' => null,
                    'order' => '7',
                ],
                [
                    'title' => 'Semua Galleri',
                    'role_id' => '1',
                    'url'  => 'admin.gallery.index',
                    'icon_class' => 'far fa-circle',
                    'parent_id' => 20,
                    'order' => '1',
                ],
                [
                    'title' => 'Kategori',
                    'role_id' => '1',
                    'url'  => 'admin.categorygallery.index',
                    'icon_class' => 'far fa-circle',
                    'parent_id' => 20,
                    'order' => '2',
                ],
                // [
                //     'title' => 'Newsletter',
                //     'role_id' => '1',
                //     'url'  => '#',
                //     'icon_class' => 'fas fa-envelope-open-text',
                //     'parent_id' => null,
                //     'order' => '8',
                // ],
                // [
                //     'title' => 'Newsletter',
                //     'role_id' => '1',
                //     'url'  => 'admin.newsletter.index',
                //     'icon_class' => 'far fa-circle',
                //     'parent_id' => 23,
                //     'order' => '1',
                // ],
                // [
                //     'title' => 'Anggota',
                //     'role_id' => '1',
                //     'url'  => 'admin.newslettermember.index',
                //     'icon_class' => 'far fa-circle',
                //     'parent_id' => 23,
                //     'order' => '2',
                // ],
                [
                    'title' => 'Agenda',
                    'role_id' => '1',
                    'url'  => '#',
                    'icon_class' => 'fas fa-calendar',
                    'parent_id' => null,
                    'order' => '9',
                ],
                [
                    'title' => 'Agenda Rutin',
                    'role_id' => '1',
                    'url'  => '/admin/agenda?agendatype=1',
                    'icon_class' => 'far fa-circle',
                    'parent_id' => 23,
                    'order' => '1',
                ],
                [
                    'title' => 'Agenda Terjadwal',
                    'role_id' => '1',
                    'url'  => '/admin/agenda?agendatype=0',
                    'icon_class' => 'far fa-circle',
                    'parent_id' => 23,
                    'order' => '2',
                ],
            ];

        \DB::table('menu_admins')->insert($items);
    }
}
