<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWelcomeMessage;
use App\Models\Metadata;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class WelcomeMessageController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $welcome = Metadata::getValueByKey(Metadata::WELCOME_MESSAGE);
        if (!isset($welcome)) {
            //jika belum ada create devault input
            $info = new Metadata(['meta_key' => Metadata::WELCOME_MESSAGE, 'type' => Metadata::TYPE_JSON]);
            $default = [
                'title' => 'Welcome Title',
                'message' => 'Message',
                'image' => ''
            ];
            $info->value = $default;
            $info->save();
            $info = Metadata::getValueByKey(Metadata::WELCOME_MESSAGE);
        }

        // dd($welcome);

        return view('admin::settings.welcome', compact('welcome'));
    }

    public function store(StoreWelcomeMessage $request)
    {
        $welcome = Metadata::getValueByKey(Metadata::WELCOME_MESSAGE);
        
        // dd($request->image->extension());
        if ($request->hasFile('image')) {
            // create unique name
            $the_file = Str::uuid() . '.' . $request->image->extension();
            $file_name_welcome = "welcome_{$the_file}";

            // resize large
            $image = Image::make($request->image);
            Storage::put("media/{$file_name_welcome}", (string)$image->resize(1024, 576)->encode('jpg', 72));
            // Image::make($request->gambar)->fit(1200, 773)->save(storage_path("app/public/l-{$file_name}"));

            $image_exists_old = Storage::exists("media/{$welcome->image}");

            // delete image
            if ($image_exists_old) {
                Storage::delete("media/{$welcome->image}");
            }
        } else {
            if (isset($welcome)) {
                $file_name_welcome = $welcome->image;
            } else {
                $file_name_welcome = '';
            }
        }

        $meta = Metadata::findByKey(Metadata::WELCOME_MESSAGE) ??
            new Metadata(['meta_key' => Metadata::WELCOME_MESSAGE, 'type' => Metadata::TYPE_JSON]);

        // update
        $data = [
            'title' => $request->title,
            'message' => html_entity_decode($request->message),
            'image' => $file_name_welcome
        ];
        $meta->value = $data;
        $meta->save();

        session()->flash('success', 'Berhasil update data');
        return redirect()->back();
    }
}
