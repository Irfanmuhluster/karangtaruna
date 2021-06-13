<?php

namespace App\Http\Controllers\Backend\NewsLetter;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsLetterContent;
use App\Models\NewsLetterContent;
use App\Models\NewsLetterMember;
use Illuminate\Http\Request;

class NewsLetterContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $newslettercontent = new NewsLetterContent();
        $datanewslettercontent = $newslettercontent->search()
            ->paginate(config('app.setting.backend.no_of_records'));
            // dd($datanewslettercontent);
        $rank = $datanewslettercontent->firstItem();
        return view('admin::newsletter.newsletter.index', compact('datanewslettercontent', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $member = NewsletterMember::total();
        return view('admin::newsletter.newsletter.create', compact('member'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsLetterContent $request)
    {
        //
        $request->validated();
        
        $member = NewsLetterMember::total();

        $newsletter = new NewsLetterContent();
        $newsletter->fill($request->all());
        $newsletter->total = $member;
        $newsletter->queue = $member;
        $newsletter->created_by_id = \Auth::id();
        $newsletter->save();

        // dd($newsletter->id);
        \DB::statement("INSERT INTO news_letter_queues (content_id, email, created_at, updated_at) SELECT " . $newsletter->id . ", email, NOW(), NOW() FROM news_letter_members WHERE unsubscribe = 0 ");

        session()->flash('success', 'Berhasil simpan data');
        return redirect()->route('admin.newsletter.index');
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
    public function edit(NewsLetterContent $newsletter)
    {
        //
        $member = NewsletterMember::total();
        return view('admin::newsletter.newsletter.update', compact('newsletter', 'member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreNewsLetterContent $request, $id)
    {
        //
        // dd(request()->all());
        $member = NewsLetterMember::total();

        $content = NewsLetterContent::find($id);
        $content->subject = $request->subject;
        $content->content = $request->content;
        $content->from_name = $request->from_name;
        $content->from_email = $request->from_email;
        $content->publish = $request->publish ?? 0;
        if($request->antrian == '1' && $content->queue == 0) {
            $content->total = $member;
            $content->queue = $member;
            \DB::statement("INSERT INTO news_letter_queues (content_id, email, created_at, updated_at) SELECT " . $request->id . ", email, NOW(), NOW() FROM news_letter_members WHERE unsubscribe = 0 ");
        }
        // $content->fill($request->all());
        $content->updated_by_id = \Auth::id();
        $content->update();


        session()->flash('success', 'Berhasil edit data');
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
        NewsLetterContent::findOrFail($id)->delete();
        return redirect()->route('admin.newsletter.index')->with('success', 'Berhasil hapus newsletter');
    }
}
