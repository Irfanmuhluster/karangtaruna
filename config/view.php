<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'paths' => [
        resource_path('views'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ),


    'fields' => [
        'hide_gallery' => [
            'type' => 'select',
            'label' => 'Sembunyikan Gallery',
            'label_en' => 'Hide Gallery',
            'options' => [
                'no' => 'Tidak',
                'yes' => 'Ya',
            ],
            'default' => 'no',
        ],
        'hide_testimoni' => [
            'type' => 'select',
            'label' => 'Sembunyikan Testimoni',
            'label_en' => 'Hide Testimoni',
            'options' => [
                'no' => 'Tidak',
                'yes' => 'Ya',
            ],
            'default' => 'no',
        ],
    ],

    /**
     * register banners
     */
     'banners' => [
        /**
         * - nama index tidak boleh pakai spasi
         * - nama index tidak boleh hanya angka
         */

        'top' => "Banner Slider",
        // 'bottom' => "Banner Bawah",
    ],

];
