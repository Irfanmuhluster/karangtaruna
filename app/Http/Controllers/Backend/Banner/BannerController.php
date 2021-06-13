<?php

namespace App\Http\Controllers\Backend\Banner;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBanner;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(!\Auth::user()->can('read_banner'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        $banner = new Banner();
        $position = $request['position'] ?? 'top';
        // abort_if(empty($request['position']), 404);

        $databanner = $banner->search()->paginate(config('app.setting.backend.no_of_records'));
        $rank = $databanner->firstItem();

        // dd($dataposition->position);
        $config = config('view');
        return view('admin::banner.index', compact('databanner','rank', 'position', 'config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(!\Auth::user()->can('create_banner'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        return view('admin::banner.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBanner $request)
    {
        //
        if(!\Auth::user()->can('create_banner'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        $image_original_name = null;

        if ($request->hasFile('images')) {
            // create unique name
            $image_original_name = Str::uuid() . '.' . $request->images->extension();
            $image_name = "banner-r-{$image_original_name}";

            $height = Image::make($request->images)->height();
            $width = Image::make($request->images)->width();

            // resize fit real width heigh
            Image::make($request->images)->fit($width, $height)->save(storage_path("app/media/{$image_name}"));


        }

        $banner = new Banner();
        $banner->position = $request->position;
        $banner->title = $request->title;
        $banner->subtitle = $request->subtitle;
        $banner->urllink = $request->urllink;
        $banner->images = $image_name;

        $bannerLatest = Banner::where('position', '=', $request->position)->max('orderby');

        $banner->orderby = $bannerLatest + 1;
        $banner->publish = $request->publish ?? 0;
        $banner->save();

        session()->flash('success', 'Berhasil simpan data');
        return redirect()->route('admin.banner.index');

    }

    public function sort(Banner $banner, $type, Request $request)
    {
        /**
         * validate parameters
         */

        $this->validateParam();

        /**
         * proses switch
         */
        $target = Banner::where('orderby', ($type == 'down') ? '>' : '<', $banner->orderby)
            ->where('position', $request->position)
            ->orderBy('orderby', 'asc')
            ->first();

        if ($target) {
            $target_order = $target->orderby;
            $banner_order = $banner->orderby;

            $target->orderby = $banner_order;
            $target->save();

            $banner->orderby = $target_order;
            $banner->save();
        }

        return redirect()->route('backend.banner.index', ['position' => request()->position]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
        if(!\Auth::user()->can('edit_banner'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        return view('admin::banner.update', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBanner $request, Banner $banner)
    {
        //
        if(!\Auth::user()->can('edit_banner'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        $image_original_name = null;

        if ($request->hasFile('image')) {
            // create unique name
            $image_original_name = Str::uuid() . '.' . $request->image->extension();
            $image_name = "banner-r-{$image_original_name}";

            $height = Image::make($request->image)->height();
            $width = Image::make($request->image)->width();

            // resize fit real width heigh
            $realimage = Image::make($request->image)->fit($width, $height);

             // delete image

            Storage::put("media/{$image_name}", (string)$realimage->encode('jpg', 72));

            $image_old_exists = Storage::exists("media/banner-r-{$banner->image}");
            if ($image_old_exists) {
               Storage::elete("media/banner-r-{$banner->image}");
           }
           
            $banner->images = $image_name;
        }
        

        $banner->title = $request->title;
        $banner->subtitle = $request->subtitle;
        $banner->urllink = $request->urllink;
        $banner->save();

        // dd($pages);
        
        session()->flash('success', 'Berhasil edit data');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!\Auth::user()->can('delete_banner'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        Banner::findOrFail($id)->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Berhasil hapus Banner');
    }
}
