<?php

namespace App\Providers;

use App\Models\Metadata;
use App\Models\User;
use Carbon\Carbon;
use Harimayco\Menu\Models\Menus;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Carbon::setLocale('id');
        $admin_theme = config('app.setting.backend.theme');
        View::addNamespace('admin', resource_path("views/admin/{$admin_theme}"));
        $this->loadViewsFrom(resource_path("views/admin/$admin_theme"), 'backend');

        $public_theme = config('app.setting.frontend.theme');
        View::addNamespace('public', resource_path("views/public/{$public_theme}"));

        Blade::component('components.alert', 'alert');

        Paginator::useBootstrap();

    
        View::composer('admin::*', function ($view) {
            if (Auth::check()) {
                $username = User::first()->name;
                config(['username' => $username ]);

            }
        });

        View::composer('public::*', function ($view) {
            // top nav
            $menu = Menus::where('id', 1)->with('items')->first();
            //you can access by model result

            //buttom nav
            $menubottom = Menus::where('id', 2)->with('items')->first();

            $public_menu = $menu->items;

            $public_menubottom = $menubottom->items;
            
            $default = 
            [
                'meta_value' => (object) [
                    // 'timezone' => 'Asia/Jakarta',
                    'title' => 'Title Website',
                    'tagline' => 'Desctipsi Website',
                    'email' => 'website@domain.com',
                    'phone' => '087734622124',
                    'address' => 'Jl. Raya Tengah Lorum Ipsum',
                    'favicon' => '',
                    'logo' => '' ,
                    'footer' => 'Copyright © 2020' ,
                    'keyword_meta_search' => '' ,
                    'keyword_description' => '',
                ]
            ];

            $meta = Metadata::findByKey(Metadata::GENERAL) ?? (object) $default ;

            $sosialmedia = Metadata::findByKey(Metadata::SOSIAL_MEDIA);

            // dd($meta->meta_value->title);
            $view->with('topnav', $public_menu);
            $view->with('bottomnav', $public_menubottom);
            $view->with('metawebsite', $meta);
            $view->with('metasosialmedia', $sosialmedia);

        });
      
        // register define gates from config
        // foreach (config('admin.gates') as $name => $views) {
        //     if (is_array($views)) {
        //         foreach ($views as $act => $function) {
        //             Gate::define("{$name}.{$act}", $function);
        //         }
        //     }
        // }
    }
}
