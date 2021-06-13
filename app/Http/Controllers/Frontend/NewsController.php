<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;

class NewsController extends Controller
{
    //
    public function index()
    {
        $news = new News();
        $datanews = $news->search()->orderby('created_at','desc')->paginate(8);
        $rank = $datanews->firstItem();
        return view('public::news.index', compact('datanews'));
    }

    public function show($title)
    {
        $news = new News();
        $detnews = $news->where('slug',$title)->first() ?? abort('404');

        $idkategory = $detnews->category->id;
        $artikelterkait = $news->where('category_id', $idkategory)->limit(3)->orderby('created_at','desc')->get();
   
        return view('public::news.show', compact('detnews','artikelterkait'));
    }

    public function showcategory($category, $categoryid)
    {
        $news = new News();
        $datanews = $news->where('category_id',$categoryid)->orderby('created_at','desc')->paginate(8);

        // $idkategory = $detnews->category->id;
        // $artikelterkait = $news->where('category_id', $idkategory)->limit(3)->get();
   
        return view('public::news.index', compact('datanews'));
    }
    
}
