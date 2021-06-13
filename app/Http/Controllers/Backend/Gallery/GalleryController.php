<?php

namespace App\Http\Controllers\Backend\Gallery;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGallery;
use App\Http\Requests\StoreGalleryCategory;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!\Auth::user()->can('read_gallery'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        $gallery = new Gallery();
        $categorigallery = New GalleryCategory();
        // abort_if(empty($request['position']), 404);

        $datagallery = $gallery->search()->paginate(config('app.setting.backend.no_of_records'));
        $rank = $datagallery->firstItem();

        $getcategory = $categorigallery->select('id','categoryname')->get();

        return view('admin::gallery.gallery.index', compact('datagallery','rank', 'getcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(!\Auth::user()->can('create_gallery'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        $categorigallery = New GalleryCategory();
        $getcategory = $categorigallery->select('id','categoryname')->get();
        return view('admin::gallery.gallery.create', compact('getcategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGallery $request)
    {
        //
        if(!\Auth::user()->can('create_gallery'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        $image_original_name = null;

        if ($request->hasFile('image')) {
            // create unique name
            $image_original_name = Str::uuid() . '.' . $request->image->extension();
            $image_name = "gallery-{$image_original_name}";

            $height = Image::make($request->image)->height();
            $width = Image::make($request->image)->width();

            // resize fit real width heigh
            $realimage = Image::make($request->image)->fit($width, $height);

            Storage::put("media/{$image_name}", (string)$realimage->encode('jpg', 72));
        }
        // insert
        $gallery = new Gallery();
        $gallery->category_id = $request->category;
        $gallery->images = $image_original_name;
        $gallery->caption = html_entity_decode($request->caption);
        $gallery->publish = 1;

        $gallery->save();
        session()->flash('success', 'Berhasil simpan data');
        return redirect()->route('admin.gallery.index');
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
    public function edit(Gallery $gallery)
    {
        //
        if(!\Auth::user()->can('edit_gallery'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        $categorigallery = New GalleryCategory();
        $getcategory = $categorigallery->select('id','categoryname')->get();
        return view('admin::gallery.gallery.update', compact('getcategory', 'gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGallery $request, Gallery $gallery)
    {
        //
        if(!\Auth::user()->can('edit_gallery'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        $image_original_name = null;

        if ($request->hasFile('image')) {
            // create unique name
            $image_original_name = Str::uuid() . '.' . $request->image->extension();
            $image_name = "gallery-{$image_original_name}";

            $height = Image::make($request->image)->height();
            $width = Image::make($request->image)->width();

            // resize fit real width heigh
            $realimage = Image::make($request->image)->fit($width, $height);

            
            Storage::put("media/{$image_name}", (string)$realimage->encode('jpg', 72));

            $image_old_exists = Storage::exists("media/gallery-{$gallery->image}");
            if ($image_old_exists) {
               Storage::delete("media/gallery-r-{$gallery->image}");
           }
           
           $gallery->images = $image_name;
        }
        // insert
        $gallery->category_id = $request->category;
        // $gallery->images = $image_original_name;
        $gallery->caption = html_entity_decode($request->caption);
        $gallery->publish = $request->publish ?? 0;

        $gallery->save();
        session()->flash('success', 'Berhasil simpan data');
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
        if(!\Auth::user()->can('delete_gallery'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        Gallery::findOrFail($id)->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Berhasil hapus gallery');
    }
}
