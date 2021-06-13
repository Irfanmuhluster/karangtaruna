<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

// ADMIN namespace
Route::namespace('Backend')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::prefix(config('app.setting.backend.slug'))->group(function () {
            Route::get('/', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('admin.home');
            Route::get('/dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('admin.home');
            // Route::get('/produk', [App\Http\Controllers\Backend\Product\ProductController::class, 'index'])->name('admin.product');
            // Route::get('/settingaccess/user/index', [App\Http\Controllers\Backend\SettingAccess\UserController::class, 'index'])->name('admin.settingaccess.user.index');
            Route::group(['middleware' => ['permission:create_user|read_user|update_user|delete_user']], function(){
                Route::resource('/settingaccess/user', '\App\Http\Controllers\Backend\SettingAccess\UserController')->except([
                    'show',
                ])->names([
                    'index' => 'admin.settingaccess.user.index',
                    'create' => 'admin.settingaccess.user.tambah',
                    'store' => 'admin.settingaccess.user.store',
                    'edit' => 'admin.settingaccess.user.edit',
                    'update' => 'admin.settingaccess.user.update',
                    'destroy' => 'admin.settingaccess.user.delete',
                ]);
            });

            Route::get('/settingaccess/user/changepassword/{id}', [App\Http\Controllers\Backend\SettingAccess\UserController::class, 'changepassword'])->name('admin.settingaccess.user.changepassword');

            Route::group(['middleware' => ['permission:create_role|read_role|update_role|delete_role']], function(){
                Route::resource('/settingaccess/role', '\App\Http\Controllers\Backend\SettingAccess\RoleController')->except([
                    'show'
                ])->names([
                    'index' => 'admin.settingaccess.role.index',
                    'create' => 'admin.settingaccess.role.tambah',
                    'store' => 'admin.settingaccess.role.store',
                    'destroy' => 'admin.settingaccess.role.delete',
                    'update' => 'admin.settingaccess.role.update',
                    'edit' => 'admin.settingaccess.role.edit',
                ]);
            });

            Route::get('/settingaccess/permission', [App\Http\Controllers\Backend\SettingAccess\PermissionController::class, 'index'])->name('admin.setting.permission');
            Route::group(['middleware' => ['permission:create_role|read_role|update_role|delete_role']], function(){
                Route::resource('/settings/menuadmin', '\App\Http\Controllers\Backend\Settings\MenuAdminController')->except([
                        'edit',
                    ])->names([
                        'show' => 'admin.setting.menu.index',
                        'create' => 'admin.setting.menu.create',
                        'store' => 'admin.setting.menu.store',
                        'update' => 'admin.setting.menu.update',
                        'destroy' => 'admin.setting.menu.destroy'
                ]);
            });

            /** news */
            Route::resource('/news', '\App\Http\Controllers\Backend\News\NewsController')->except([
                'show',
            ])->names([
                'index' => 'admin.news.index',
                'create' => 'admin.news.create',
                'store' => 'admin.news.store',
                'update' => 'admin.news.update',
                'destroy' => 'admin.news.destroy',
                'edit'  => 'admin.news.edit'
            ]);

              /** category news */
            Route::resource('/newscategory', '\App\Http\Controllers\Backend\News\NewsCategoryController')->names([
                'index' => 'admin.newscategory.index',
                'create' => 'admin.newscategory.create',
                // 'detail' => 'admin.newscategory.show',
                'edit' => 'admin.newscategory.edit',
                'store' => 'admin.newscategory.store',
                'update' => 'admin.newscategory.update',
                'destroy' => 'admin.newscategory.destroy',
            ]);

            
            Route::get('/newscategory/detail', [App\Http\Controllers\Backend\News\NewsCategoryController::class, 'show'])->name('admin.newscategory.show');
            Route::post('/newscategory/update-category', [App\Http\Controllers\Backend\News\NewsCategoryController::class, 'updateCategory'])->name('admin.newscategory.update-category');
           

            /** Banner */
            Route::resource('/banner', '\App\Http\Controllers\Backend\Banner\BannerController')->names([
                'index' => 'admin.banner.index',
                'show' => 'admin.banner.show',
                'create' => 'admin.banner.create',
                'store' => 'admin.banner.store',
                'update' => 'admin.banner.update',
                'destroy' => 'admin.banner.destroy',
                'edit'  => 'admin.banner.edit',
                // 'sort' => 'admin.banner.sort',
            ]);
            Route::get('/banner/sort', [App\Http\Controllers\Backend\Banner\BannerController::class, 'sort'])->name('admin.banner.sort');

            Route::resource('/pages', '\App\Http\Controllers\Backend\Pages\PagesController')->names([
                'index' => 'admin.page.index',
                'show' => 'admin.page.show',
                'create' => 'admin.page.create',
                'store' => 'admin.page.store',
                'update' => 'admin.page.update',
                'destroy' => 'admin.page.destroy',
                'edit'  => 'admin.page.edit'
            ]);

            Route::resource('/agenda', '\App\Http\Controllers\Backend\Agenda\AgendaController')->names([
                'index' => 'admin.agenda.index',
                'create' => 'admin.agenda.create',
                'store' => 'admin.agenda.store',
                'update' => 'admin.agenda.update',
                'destroy' => 'admin.agenda.destroy',
                'edit'  => 'admin.agenda.edit'
            ]);

            Route::resource('/gallery', '\App\Http\Controllers\Backend\Gallery\GalleryController')->names([
                'index' => 'admin.gallery.index',
                'show' => 'admin.gallery.show',
                'create' => 'admin.gallery.create',
                'store' => 'admin.gallery.store',
                'update' => 'admin.gallery.update',
                'destroy' => 'admin.gallery.destroy',
                'edit'  => 'admin.gallery.edit'
            ]);

            Route::post('/categorygallery/update', [App\Http\Controllers\Backend\Gallery\CategoryGalleryController::class, 'update'])->name('admin.categorygallery.update');
            Route::get('/categorygallery/detail', [App\Http\Controllers\Backend\Gallery\CategoryGalleryController::class, 'show'])->name('admin.categorygallery.show');
           

            Route::resource('/categorygallery', '\App\Http\Controllers\Backend\Gallery\CategoryGalleryController')->names([
                'index' => 'admin.categorygallery.index',
                'create' => 'admin.categorygallery.create',
                'store' => 'admin.categorygallery.store',
                // 'update' => 'admin.categorygallery.update',
                'destroy' => 'admin.categorygallery.destroy',
                'edit'  => 'admin.categorygallery.edit'
            ]);

            Route::resource('/newsletter/member', '\App\Http\Controllers\Backend\NewsLetter\NewsLetterMemberController')->names([
                'index' => 'admin.newslettermember.index',
                'show' => 'admin.newslettermember.show',
                'create' => 'admin.newslettermember.create',
                'store' => 'admin.newslettermember.store',
                'update' => 'admin.newslettermember.update',
                'delete' => 'admin.newslettermember.destroy',
                'edit'  => 'admin.newslettermember.edit'
            ]);

            Route::resource('/newsletter', '\App\Http\Controllers\Backend\NewsLetter\NewsLetterContentController')->names([
                'index' => 'admin.newsletter.index',
                'show' => 'admin.newsletter.show',
                'create' => 'admin.newsletter.create',
                'store' => 'admin.newsletter.store',
                'update' => 'admin.newsletter.update',
                'destroy' => 'admin.newsletter.destroy',
                'edit'  => 'admin.newsletter.edit'
            ]);
            

            Route::get('/settings/welcome_setting', [App\Http\Controllers\Backend\Settings\WelcomeMessageController::class, 'index'])->name('admin.setting.welcome.index');
            
            Route::get('/settings/sosial_media', [App\Http\Controllers\Backend\Settings\SettingController::class, 'sosial_media'])->name('admin.setting.sosial_media');
            Route::put('/settings/sosial_media/update', [App\Http\Controllers\Backend\Settings\SettingController::class, 'sosial_media_update'])->name('admin.setting.sosial_media.update');
           
           
            Route::post('/settings/welcome_setting/store', [App\Http\Controllers\Backend\Settings\WelcomeMessageController::class, 'store'])->name('admin.setting.welcome.store');

            Route::get('/settings', [App\Http\Controllers\Backend\Settings\SettingController::class, 'index'])->name('admin.setting.index');

            Route::get('/settings/template', [App\Http\Controllers\Backend\Settings\SettingController::class, 'template'])->name('admin.setting.template');
            Route::put('/settings/template-update', [App\Http\Controllers\Backend\Settings\SettingController::class, 'templateUpdate'])->name('admin.setting.templateUpdate');

            Route::put('/settings/update/', [App\Http\Controllers\Backend\Settings\SettingController::class, 'update'])->name('admin.setting.update');
            

            Route::get('/settings/emailtemplate', [App\Http\Controllers\Backend\Settings\SettingController::class, 'emailTemplate'])->name('admin.setting.emailtemplate');
            Route::get('/settings/emailtemplate/{id}', [App\Http\Controllers\Backend\Settings\SettingController::class, 'editemailTemplate'])->name('admin.setting.emailtemplate.edit');

            Route::post('/settings/menuadmin/updatemenus', [App\Http\Controllers\Backend\Settings\MenuAdminController::class, 'orderupdate'])->name('admin.setting.menu.orderupdate');
            Route::get('/settings/menupublic', [App\Http\Controllers\Backend\Settings\MenuPublicController::class, 'index'])->name('admin.setting.menupublic.index');
            Route::get('/settings/menupublic?menu={menu}', [App\Http\Controllers\Backend\Settings\MenuPublicController::class, 'index'])->name('admin.setting.menupublic.show');
            
            /** kontak */
            Route::get('/contact', [App\Http\Controllers\Backend\Contact\ContactController::class, 'index'])->name('admin.contact.index');
            Route::get('/contact/unread', [App\Http\Controllers\Backend\Contact\ContactController::class, 'unread'])->name('admin.contact.unread');
            Route::get('/contact/read', [App\Http\Controllers\Backend\Contact\ContactController::class, 'read'])->name('admin.contact.read');

            Route::get('/contact/reply/{id}', [App\Http\Controllers\Backend\Contact\ContactController::class, 'reply'])->name('admin.contact.reply');
            
            Route::put('/contact/reply/{id}', [App\Http\Controllers\Backend\Contact\ContactController::class, 'updatereply'])->name('admin.contact.updatereply');
            
            // Route::post('/settings/menuadmin/', [App\Http\Controllers\Backend\Settings\MenuAdminController::class, 'store'])->name('admin.setting.permission.store');
            // Route::delete('/settings/menuadmin/{id}/delete', [App\Http\Controllers\Backend\Settings\MenuAdminController::class, 'destroy'])->name('admin.setting.permission.destroy');
            // Route::patch('/settings/menuadmin/{id}', [App\Http\Controllers\Backend\Settings\MenuAdminController::class, 'update'])->name('admin.setting.permission.update');
            
            // Route::get('/settings/menu_admin', [App\Http\Controllers\Backend\Settings\MenuAdminController::class, 'index'])->name('admin.setting.menu_admin');
            Route::put('/settingaccess/permission/{role}', [App\Http\Controllers\Backend\SettingAccess\PermissionController::class, 'setRolePermission'])->name('users.setRolePermission');
            Route::post('/dashboard/logout', [App\Http\Controllers\Backend\DashboardController::class, 'logout'])->name('admin.logout');
        });
    });
});

// Public namespace
Route::namespace('Frontend')->group(function () {
    Route::get('/', [App\Http\Controllers\Frontend\DashboardController::class, 'index'])->name('public.home');
    Route::get('/unsubscribe/{id}/{encriptmail}', [App\Http\Controllers\Frontend\NewsletterController::class,'unsubscribe'])->name('newsletter.unsubscribe');
    Route::get('/berita', [App\Http\Controllers\Frontend\NewsController::class,'index'])->name('public.news');
    Route::get('/berita/{category}/{categoryid}', [App\Http\Controllers\Frontend\NewsController::class,'showcategory'])->name('public.news.category');
    Route::get('/berita/{title}', [App\Http\Controllers\Frontend\NewsController::class,'show'])->name('public.news.detail');
    Route::get('/gallery', [App\Http\Controllers\Frontend\GalleryController::class,'index'])->name('public.gallery');
    Route::get('/agenda', [App\Http\Controllers\Frontend\AgendaController::class,'index'])->name('public.agenda');
    Route::get('/{title?}', [App\Http\Controllers\Frontend\PageController::class,'index'])->name('public.page.detail');
});