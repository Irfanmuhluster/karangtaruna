<?php

namespace App\Http\Controllers\Backend\Gallery;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGalleryCategory;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;

class CategoryGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!\Auth::user()->can('read_gallerycategory'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        $category = new GalleryCategory();
        $datacategory = $category->search()
            ->paginate(config('app.setting.backend.no_of_records'));
        $rank = $datacategory->firstItem();
        return view('admin::gallery.gallerycategory.index', compact('rank', 'datacategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(!\Auth::user()->can('create_gallerycategory'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        return view('admin::gallery.gallerycategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGalleryCategory $request)
    {
        //
        if(!\Auth::user()->can('read_gallerycategory'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        $category = new GalleryCategory();
        $category->categoryname = $request->category_name;

        $category->save();
        session()->flash('success', 'Berhasil simpan data');
        return redirect()->route('admin.categorygallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $gallery = GalleryCategory::find($request->id);
        return response()->json(['success' => 1, 'gallerycategory' => $gallery]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        if(!\Auth::user()->can('edit_gallerycategory'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        $validate = new StoreGalleryCategory();
        
        $validated = \Validator::make($request->all(), $validate->rules(), [], $validate->attributes());

        if (! $validated->fails()) {
            // dd($request);
            $category = GalleryCategory::find($request->id);
            $category->categoryname = $request->category_name;
            $category->save();

            // session()->flash('success', __('news::trans.edit_category_success'));
            return redirect()->route('admin.categorygallery.index')->with('success', 'Berhasil update Kategori');
            // return redirect()->route('backend.news.category.index', [ 'form_active' => 'update', 'id' => $request->id ]);
        }

        $validated->errors()->add('form_active', 'update');
        return redirect()->route('admin.categorygallery.index')->withErrors($validated);
   
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
        if(!\Auth::user()->can('delete_gallerycategory'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        GalleryCategory::findOrFail($id)->delete();
        return redirect()->route('admin.categorygallery.index')->with('success', 'Berhasil hapus Kategori');
    }
}
