<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    //
    public function index()
    {
        # code...
        $agenda = new Agenda();
        $dataagenda = $agenda->orderby('created_at','desc')->whereAgendatype(0)->paginate(6);
        // dd($listcategory);
        return view('public::agenda.index', compact('dataagenda'));
    }

}
