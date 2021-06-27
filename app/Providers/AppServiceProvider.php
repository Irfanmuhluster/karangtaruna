<?php

namespace App\Providers;

use App\Models\Metadata;
use App\Models\User;
use Carbon\Carbon;
use Harimayco\Menu\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Shetabit\Visitor\Middlewares\LogVisits;
use Shetabit\Visitor\Models\Visit;
use Shetabit\Visitor\Traits\Visitor;
use Shetabit\Visitor\Traits\Visitable;
use Illuminate\Support\Facades\DB;

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
     * Register array function yang akan diteruskan ke view
     */
    public function registerViewFunctions()
    {
        return [
            'get' => function () {
                return 'sample from dashboard';
            },

            /**
             * untuk ambil statistik visitor pada periode tertentu
             *
             * @param string $periode online|today|last_week|last_month|last_year||all_time
             * @author Almazari <almazary@jogjacamp.co.id>
             */
            'visitor_stats' => function ($periode) {
                switch ($periode) {
                    case 'online':
                        /**
                         * cek dulu dicache ada gak
                         */
                        $cache_key = "visitor_stats_online_public";
                        $agg = Cache::get($cache_key);
                        // dd('woyy'.website()->id);
                        if (is_null($agg)) {
                            $agg = Visit::
                                select(DB::raw('count(distinct(concat(`ip`, date(`created_at`)))) as aggregate'))
                                ->where('updated_at', '>=', now()->subMinutes(2)->format('Y-m-d H:i:s'))
                                ->whereNull('visitor_id')
                                ->first()['aggregate'];

                            /**
                             * simpan cache 1 menit
                             */
                            Cache::put($cache_key, $agg, now()->addMinute());
                        }

                        return $agg;
                        break;

                    case 'today':
                        /**
                         * cek dulu dicache ada gak
                         */
                        $cache_key =  "visitor_stats_today_public";
                        $agg = Cache::get($cache_key);
                        // dd($agg);
                        if (is_null($agg)) {
                            $agg = Visit::
                                select(DB::raw('count(distinct(concat(`ip`, date(`created_at`)))) as aggregate'))
                                ->whereDate('created_at', now()->format('Y-m-d'))
                                ->whereNull('visitor_id')
                                ->first()['aggregate'];
                            
                            /**
                             * simpan cache 5 menit
                             */
                            Cache::put($cache_key, $agg, now()->addMinutes(10));
                        }
                        // dd($agg);
                        return $agg;
                        break;

                    case 'last_week':
                        /**
                         * cek dulu dicache ada gak
                         */
                        $cache_key =  "visitor_stats_last_week_public";
                        $agg = Cache::get($cache_key);
                        if (is_null($agg)) {
                            $agg = Visit::
                                select(DB::raw('count(distinct(concat(`ip`, date(`created_at`)))) as aggregate'))
                                ->whereDate('created_at', '>=', now()->subWeek()->format('Y-m-d'))
                                ->whereNull('visitor_id')
                                ->first()['aggregate'];

                            /**
                             * simpan cache 2 jam
                             */
                            Cache::put($cache_key, $agg, now()->addMinutes(10));
                        }

                        return $agg;
                        break;

                    case 'last_month':
                        /**
                         * cek dulu dicache ada gak
                         */
                        $cache_key =  "visitor_stats_last_month_public";
                        $agg = Cache::get($cache_key);
                        if (is_null($agg)) {
                            $agg = Visit::
                                select(DB::raw('count(distinct(concat(`ip`, date(`created_at`)))) as aggregate'))
                                ->whereDate('created_at', '>=', now()->subMonth()->format('Y-m-d'))
                                ->whereNull('visitor_id')
                                ->first()['aggregate'];

                            /**
                             * simpan cache 12 jam
                             */
                            Cache::put($cache_key, $agg, now()->addMinutes(10));
                        }

                        return $agg;
                        break;

                    case 'last_year':
                        /**
                         * cek dulu dicache ada gak
                         */
                        $cache_key = "visitor_stats_last_year_public";
                        $agg = Cache::get($cache_key);
                        if (is_null($agg)) {
                            $agg = Visit::
                                select(DB::raw('count(distinct(concat(`ip`, date(`created_at`)))) as aggregate'))
                                ->whereDate('created_at', '>=', now()->subYear()->format('Y-m-d'))
                                ->whereNull('visitor_id')
                                ->first()['aggregate'];

                            /**
                             * simpan cache 12 jam
                             */
                            Cache::put($cache_key, $agg, now()->addMinutes(10));
                        }

                        return $agg;
                        break;

                    case 'all_time':
                        /**
                         * cek dulu dicache ada gak
                         */
                        $cache_key = "visitor_stats_all_time_public";
                        $agg = Cache::get($cache_key);
                        if (is_null($agg)) {
                            $agg = Visit::
                                select(DB::raw('count(distinct(concat(`ip`, date(`created_at`)))) as aggregate'))
                                ->whereNull('visitor_id')
                                ->first()['aggregate'];

                            /**
                             * simpan cache 12 jam
                             */
                            Cache::put($cache_key, $agg, now()->addMinutes(10));
                        }

                        return $agg;
                        break;
                }
            },
        ];
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
            Request::visitor()->visit();
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
                    'keyword_meta_search' => 'keyword website, disini' ,
                    'keyword_meta_description' => 'deskripsi website disini',
                ]
            ];

            $meta = Metadata::findByKey(Metadata::GENERAL) ?? (object) $default ;

            $sosialmedia = Metadata::findByKey(Metadata::SOSIAL_MEDIA);

            // dd($meta->meta_value->title);
            $view->with('topnav', $public_menu);
            $view->with('bottomnav', $public_menubottom);
            $view->with('metawebsite', $meta);
            $view->with('metasosialmedia', $sosialmedia);

            
            View::share('_mf', $this->registerViewFunctions());
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

    /**
     * Register function yang akan dipanggil diview
     */
    // $modulefunction->register('dashboard', $this->registerViewFunctions());
}
