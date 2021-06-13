<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\NewsLetterMember;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    //
    public function unsubscribe($id, $encriptmail)
    {
        if ($encriptmail != '' && intval($id) > 0 ) {
            $member = NewsLetterMember::where('id', intval($id))
                ->whereRaw("md5(email) = '" . $encriptmail . "'")
                ->first();

            if (! is_null($member)) {
                // cek sudah unsubscribe blm
                if ($member->unsubscribe == 0) {
                    // unsubscribe member
                    NewsletterMember::where('id', intval($id))
                        ->update(['unsubscribe' => 1]);

                    // kirim email berhasil unsubscribe
                    // $email = Metadata::getValueByKey(Metadata::EMAIL_SERVER);
                    // $info = Metadata::getValueByKey(Metadata::GENERAL);

                    // if (isset($member->email) && $member->email != '') {
                    //     Mail::to($member->email)->send( new UnsubscribeNewsletterMail($member, $email, $info) );
                    // }

                    session()->flash('success', 'Berhasil Unsubcribe Email');

                } else {
                    session()->flash('danger', 'Ulangi Unsubcribe Email');
                }
            } else {
                session()->flash('danger', 'Gagal Unsubcribe Email');
            }
        }

        // return view('newsletter-frontend::unsubscribe.index');
    }
}
