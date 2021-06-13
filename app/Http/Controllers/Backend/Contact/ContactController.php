<?php

namespace App\Http\Controllers\Backend\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReplyContactUs;
use App\Mail\ContactUsReply;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contact = new ContactUs();
        $datacontact = $contact->search()->paginate(config('app.setting.backend.no_of_records'));

        $datacontact->is_home = 1;
        $rank = $datacontact->firstItem();

        return view('admin::contact.index', compact('datacontact', 'rank'));
    }

    public function unread()
    {
        //
        $contact = new ContactUs();
        $datacontact = $contact->search()->where('is_reply', 0)->paginate(config('app.setting.backend.no_of_records'));
        $rank = $datacontact->firstItem();

        $datacontact->is_unread = 1;
        return view('admin::contact.index', compact('datacontact', 'rank'));
    }

    public function read()
    {
        //
        $contact = new ContactUs();
        $datacontact = $contact->search()->where('is_reply', 1)->paginate(config('app.setting.backend.no_of_records'));
        $rank = $datacontact->firstItem();

        $datacontact->is_replied = 1;
        return view('admin::contact.index', compact('datacontact', 'rank'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reply($id)
    {
        //
        // $contact = new ContactUs();
        $datacontact = ContactUs::findOrFail($id);

        return view('admin::contact.reply', compact('datacontact'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatereply(StoreReplyContactUs $request, $id)
    {
        //
        // dd($request);
        if ($request->from_page == 'unread') {
            $redirect = 'admin.contact.unread';
        }
        elseif ($request->from_page == 'replied') {
            $redirect = 'admin.contact.read';
        }
        else {
            $redirect = 'admin.contact.index';
        }


        try {
           
            if ($request->email != null){
                // cek attachment
                $request->image = ($request->image !== null) ? $request->image : null;
                 // simpan ke database

                // dikirim ke visitor
                Mail::to($request->email, $request->name)->send(new ContactUsReply($request, 'contact-reply'));
            
            }
            
            // simpan ke database
            $update = new ContactUs();
         
            $update = ContactUs::findOrFail($id);
            $update->reply_msg = $request->reply_msg;
            $update->is_reply = 1;
            $update->update();
            $return = redirect()->route($redirect);
        
            session()->flash('success', 'Pesan Berhasil dibalas');
            // dd('yoiiillahhh');
            return $return;
        } catch (\Exception $e){
            $success = 'gagal'.$e;

            session()->flash('errors', $success);
            return redirect()->back();
        }



        // return view('admin::contact.index', compact('datacontact', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
