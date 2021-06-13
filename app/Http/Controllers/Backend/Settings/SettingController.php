<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSetting;
use App\Models\MailTemplate;
use App\Models\Metadata;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        // Gate::authorize('Setting.main.index');

        /**
         * ambil record settings
         */
        $meta = Metadata::firstOrCreate(
            [
                'meta_key' => Metadata::GENERAL,
                'type' => 1,
            ],
            [
                'meta_value' => [
                    // 'timezone' => 'Asia/Jakarta',
                    'title' => 'Title Website',
                    'tagline' => 'Desctipsi Website',
                    'email' => 'website@domain.com',
                    'phone' => '087734622124',
                    'favicon' => '',
                    'logo' => '' ,
                    'address' => 'Jl. Raya Jaya',
                    'footer' => 'Copyright © 2020' ,
                    'keyword_meta_search' => '' ,
                    'keyword_meta_description' => '',
                    'publish' => 1,
                ],
                'type' => 1,
            ]
        );
        // dd($meta->meta_value);
        return view('admin::settings.index', ['setting' => $meta->value]);
    }

    public function sosial_media()
    {
        /**
         * ambil record settings
         */
        $sosial_media = Metadata::firstOrCreate(
            [
                'meta_key' => Metadata::SOSIAL_MEDIA,
                'type' => 1,
            ],
            [
                'meta_value' => [
                    [
                        'title_fb' => 'Facebook',
                        'link_fb' => '',
                     ],
                     [
                        'title_twitter' => 'Twitter',
                        'link_twitter' => '',
                     ],
                     [
                        'title_wa' => 'Whatapps',
                        'link_wa' => '',
                     ],
                     [
                        'title_yt' => 'Youtube',
                        'link_yt' => '',
                     ],
                     [
                        'title_instagram' => 'Instagram',
                        'link_instagram' => '',
                     ],
                ],
                'type' => 1,
            ]
             
        );
        
        return view('admin::settings.sosialmedia', ['sosial_media' => $sosial_media->meta_value]);
    }

    public function sosial_media_update(Request $request)
    {
        # code...

        $meta = Metadata::findByKey(Metadata::SOSIAL_MEDIA);
        // dd($meta);
        abort_if(empty($meta), 404);
        $data = $request->only([
            'link_fb',
            'link_wa',
            'link_instagram',
            'link_yt',
            'link_twitter',
            'footer',
        ]);

        $meta->value = $data;
        $meta->save();

        
        session()->flash('success', 'Berhasil update data');
        return redirect()->back();
    }


     /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(StoreSetting $request)
    {

        $meta = Metadata::findByKey(Metadata::GENERAL);
        // dd($meta);
        abort_if(empty($meta), 404);

        $favicon_name = optional($meta->meta_value)->favicon;
        if ($request->hasFile('favicon')) {
            /**
             * hapus file sebelumnya
             */
            if (!empty($favicon_name)) {
                Storage::disk('public')->delete("media/{$favicon_name}");
            }

            // create unique name
            $favicon_name = 'favicon-' . Str::uuid() . '.' . $request->favicon->extension();

            /**
             * untuk .ico gak perlu diresize, cukup divalidasi dari mimes
             */
            Storage::put("media/{$favicon_name}", file_get_contents($request->file('favicon')->getRealPath()));
        }

        $logo_name = optional($meta->meta_value)->logo;
        if ($request->hasFile('logo')) {
            /**
             * hapus file sebelumnya
             */
            if (!empty($logo_name)) {
                Storage::disk('public')->delete("media/{$logo_name}");
            }

            // create unique name
            $logo_name = 'logo-' . Str::uuid() . '.' . $request->logo->extension();

            $height = Image::make($request->logo)->height() - 5;
            $width = Image::make($request->logo)->width() - 5;

            // resize fit real width heigh
            $realimage = Image::make($request->logo)->fit($width, $height);
            Storage::put("media/{$logo_name}", (string)$realimage->encode());
        }

        $data = $request->only([
            'title',
            'tagline',
            'email',
            'phone',
            'address',
            'footer',
            'keyword_meta_search',
            'keyword_meta_description',
        ]);

        $data['favicon'] = $favicon_name;
        $data['logo'] = $logo_name;

        $meta->value = $data;
        $meta->save();


        session()->flash('success', 'Berhasil update data');
        return redirect()->back();
    }
    
    //
    public function emailTemplate()
    {
        $emailtemplate = new MailTemplate();
        $dataemailtemplate = $emailtemplate->search()->paginate(config('app.setting.backend.no_of_records'));

        return view('admin::settings.emailtemplate', compact('dataemailtemplate'));
    }

    public function editemailTemplate($id)
    {
        $emailtemplate = new MailTemplate();
        $dataemailtemplate = $emailtemplate->findOrFail($id);

        return view('admin::settings.editemailtemplate', compact('dataemailtemplate'));
    }

    public function template()
    {
        # code...
        $config = config('view');
        // dd($config);
        return view('admin::settings.template', compact('config'));
    }

    public function templateUpdate(Request $request)
    {
        # code...
        $config = config('view');

        foreach ($request->only(array_keys($config['fields'])) as $key => $v) {
            $k = "theme::{$key}";
            Metadata::updateOrCreate(
                ['meta_key' => $k, 'type' => 0],
                ['meta_value' => $v ?? '']
            );
        }

        session()->flash('success', 'berhasil tambah data');
        return redirect()->back();
    }
}
