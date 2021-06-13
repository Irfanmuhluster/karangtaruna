<?php

namespace App\Http\Controllers\Backend\Agenda;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAgenda;
use App\Models\Agenda;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!\Auth::user()->can('read_agenda'))
        {
            abort('403');
        }
        $agenda = new Agenda();
        $dataagenda = $agenda->search()->paginate(config('app.setting.backend.no_of_records'));
        $rank = $dataagenda->firstItem();
        return view('admin::agenda.index', compact('dataagenda', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(!\Auth::user()->can('create_agenda'))
        {
            abort('403');
        }
        return view('admin::agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgenda $request)
    {
        //
        if(!\Auth::user()->can('create_agenda'))
        {
            abort('403');
        }
        $agenda = new Agenda();
        $agenda->agendatype = $request->agendatype;
        $agenda->title = $request->title;
        $agenda->every = $request->every;
        $agenda->event_date = ($request->event_date !== null ) ? Carbon::parse($request->event_date)->toDateString() : null;
        $agenda->content = html_entity_decode($request->content);
        $agenda->publish = $request->has('publish');
        $agenda->save();

        session()->flash('success', 'Data Berhasil disimpan');
        return redirect()->route('admin.agenda.index', ['agendatype' => $request->agendatype]);
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
    public function edit(Agenda $agenda)
    {
        //
        if(!\Auth::user()->can('edit_agenda'))
        {
            abort('403');
        }
        return view('admin::agenda.update', compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAgenda $request, Agenda $agenda)
    {
        //
        if(!\Auth::user()->can('edit_agenda'))
        {
            abort('403');
        }
        $agenda->agendatype = $request->agendatype;
        $agenda->title = $request->title;
        $agenda->every = $request->every;
        $agenda->event_date = ($request->event_date !== null ) ? Carbon::parse($request->event_date)->toDateString() : null;
        $agenda->content = html_entity_decode($request->content);
        $agenda->publish = $request->has('publish');
        $agenda->save();

        session()->flash('success', 'Data Berhasil disimpan');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if(!\Auth::user()->can('delete_agenda'))
        {
            abort('403', 'Hak Akses Tidak Diijinkan');
        }
        Agenda::findOrFail($id)->delete();
        return redirect()->route('admin.agenda.index', ['agendatype' => $request->agendatype])->with('success', 'Berhasil hapus Agenda');
    }
}
