<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function index($title)
    {
        # code...
        $page = new Pages();
        $datapage = $page->where('slug',$title)->first() ?? abort('404');
        return view('public::page.index', compact('datapage'));
    }

}
