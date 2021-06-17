<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Metadata;
use App\Models\Banner;
use App\Models\Gallery;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        # code...
        // welcome message
        // dd($request->visitor()->visit());
        $default = [
            'title' => 'Welcome Title',
            'message' => 'Message',
            'image' => ''
        ];
        $welcome_message = Metadata::getValueByKey(Metadata::WELCOME_MESSAGE) ?? (object) $default;

        $banner = Banner::select('title','subtitle','urllink','images','publish')->where('publish', 1)->limit(5)->get();

        $news = News::with('category')->where('publish', 1)->limit(6)->get();

        $month = Carbon::now()->month;
        $agenda = Agenda::whereMonth('event_date', '=', $month)->whereAgendatype(0)->wherePublish(1)->limit(6)->get();

        $agendarutin = Agenda::whereAgendatype(1)->wherePublish(1)->limit(6)->get();
        
        $gallery = Gallery::wherePublish(1)->limit(4)->get();

        return view('public::index', compact('welcome_message', 'banner', 'news', 'agenda', 'agendarutin', 'gallery'));
    }
}
