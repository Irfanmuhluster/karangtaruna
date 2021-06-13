<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    //
    public function index()
    {
        # code...
        $gallery = new Gallery();
        $datagallery = $gallery->search()->orderby('created_at','desc')->paginate(8);
        $listcategory = GalleryCategory::orderby('created_at','desc')->get();
        // dd($listcategory);
        return view('public::gallery.index', compact('datagallery', 'listcategory'));
    }
}
