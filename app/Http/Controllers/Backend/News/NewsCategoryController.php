<?php

namespace App\Http\Controllers\Backend\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsCategory;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!\Auth::user()->can('read_newscategory'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        $category = new NewsCategory();
        $datacategory = $category->search()
            ->paginate(config('app.setting.backend.no_of_records'));
        $rank = $datacategory->firstItem();
        return view('admin::newscategory.index', compact('datacategory', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(!\Auth::user()->can('create_newscategory'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        return view('admin::newscategory.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsCategory $request)
    {
        //
        if(!\Auth::user()->can('create_newscategory'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        $validated = \Validator::make($request->all() ,[
            'category_name' => ['required','unique:App\Models\NewsCategory,category_name', 'max:255'],
            // 'slug' => ['nullable', 'max:255', 'unique:categories,slug', 'alpha_dash'],
            'description' => ['nullable', 'string'],
        ],
        $messages = [
            'category_name.required' => 'Kategori harus diisi',
            'category_name.unique' => 'Kategori sudah ada',
        ]);

        if (! $validated->fails()) {
            
            $c = new NewsCategory();
            $c->category_name = $request->category_name;
            $c->slug = Str::slug($request->category_name, '-');
            $c->description =  $request->description ?? null;

            $c->save();

            return redirect()->route('admin.newscategory.index')->with('success', 'Berhasil tambah Kategori');
        }

        $validated->errors()->add('form_active', 'store');
        return redirect()->route('admin.newscategory.index')->withErrors($validated);

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
        $news = NewsCategory::find($request->id);
        return response()->json(['success' => 1, 'newscategory' => $news]);
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
    public function update(Request $request, $id)
    {
        //
    }

    public function updateCategory(Request $request)
    {
        if(!\Auth::user()->can('edit_newscategory'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        $validate = new StoreNewsCategory();
        
        $validated = \Validator::make($request->all(), $validate->rules(), [], $validate->attributes());

        if (! $validated->fails()) {
            // dd($request);
            $category = NewsCategory::find($request->id);
            $category->category_name = $request->category_name;
            $category->description = $request->description;
            $category->save();

            // session()->flash('success', __('news::trans.edit_category_success'));
            return redirect()->route('admin.newscategory.index')->with('success', 'Berhasil update Kategori');
            // return redirect()->route('backend.news.category.index', [ 'form_active' => 'update', 'id' => $request->id ]);
        }

        $validated->errors()->add('form_active', 'update');
        return redirect()->route('admin.newscategory.index')->withErrors($validated);
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
        if(!\Auth::user()->can('delete_newscategory'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        NewsCategory::findOrFail($id)->delete();
        return redirect()->route('admin.newscategory.index')->with('success', 'Berhasil hapus Kategori');
    }
}
