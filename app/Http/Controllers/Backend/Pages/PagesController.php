<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Pages;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!\Auth::user()->can('read_page'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        $page = new Pages();

        $datapage = $page->search()
            ->paginate(config('app.setting.backend.no_of_records'));
        $rank = $datapage->firstItem();
        return view('admin::page.index', compact('datapage','rank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(!\Auth::user()->can('create_page'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        return view('admin::page.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePage $request)
    {
        //
        if(!\Auth::user()->can('store_page'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        $image_original_name = null;

        if ($request->hasFile('image')) {
            // create unique name
            $image_original_name = Str::uuid() . '.' . $request->image->extension();
            $image_name = "page-r-{$image_original_name}";

            $height = Image::make($request->image)->height();
            $width = Image::make($request->image)->width();

            // resize fit real width heigh
            $realimage = Image::make($request->image)->fit($width, $height);

            Storage::put("media/{$image_name}", (string)$realimage->encode('jpg', 72));
        }
        

        $page = new Pages();
        $page->title = $request->title;
        $page->image = $image_name ?? null;
        $page->content = html_entity_decode($request->content);

        $page->slug = Str::slug($request->title);
        $page->published = $request->publish ?? 0;
        $page->created_by_id = \Auth::id();

        $page->save();
        session()->flash('success', 'Berhasil simpan data');
        return redirect()->route('admin.page.index');
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
    public function edit(Pages $page)
    {
        //
        if(!\Auth::user()->can('edit_page'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        return view('admin::page.update', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePage $request, Pages $page)
    {
        //
        if(!\Auth::user()->can('edit_page'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        $image_original_name = null;

        if ($request->hasFile('image')) {
            // create unique name
            $image_original_name = Str::uuid() . '.' . $request->image->extension();
            $image_name = "page-r-{$image_original_name}";

            $height = Image::make($request->image)->height();
            $width = Image::make($request->image)->width();

            // resize fit real width heigh
            $realimage = Image::make($request->image)->fit($width, $height);

             // delete image

            Storage::disk('public')->put("media/{$image_name}", (string)$realimage->encode('jpg', 72));

            $image_old_exists = Storage::disk('public')->exists("media/page-r-{$page->image}");
            if ($image_old_exists) {
               Storage::disk('public')->delete("media/page-r-{$page->image}");
           }
           
            $page->image = $image_name;
        }
        

        $page->title = $request->title;
        $page->content = html_entity_decode($request->content);

        $page->slug = ($request->slug != null ) ? $request->slug : date("dmYs").'-'.Str::slug($request->title);
        $page->published = $request->publish ?? 0;
        $page->created_by_id = \Auth::id();
        $page->updated_by_id = \Auth::id();
        $page->save();

        // dd($pages);

        
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
        if(!\Auth::user()->can('delete_page'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        Pages::findOrFail($id)->delete();
        return redirect()->route('admin.page.index')->with('success', 'Berhasil hapus halaman');
    }
}
