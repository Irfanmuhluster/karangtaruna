<?php

namespace App\Mail;

use App\Models\MailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsReply extends Mailable
{
    use Queueable, SerializesModels;

    protected $receiver;
    protected $settings;
    protected $template;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($receiver, $type = 'contact-reply')
    {
        // get setting
        // $src_set  = new ContactUsSettingsController();
        $this->receiver = $receiver;
        // $this->settings = $src_set->getSettings();
        $this->template = MailTemplate::whereTemplateName($type)->first();
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (empty($this->template)) return false;

        $subject = $this->template->subject;
        $template = $this->template->content;

        $attachfile = '';
        if (!empty($this->receiver->attachfile)) {
            $attachfile = route('user.media', ['path' => 'contactus/' . $this->receiver->attachfile]);
        }

        $body = simple_parser($template, [
                'add_contact_name' => ($this->receiver->name !== null) ? $this->receiver->name : '-',
                'name' => ($this->receiver->name !== null) ? $this->receiver->name : '-',
                'email' => ($this->receiver->email !== null) ? $this->receiver->email : '-',
                'phone' => ($this->receiver->phone !== null) ? $this->receiver->phone : '-',
                'address' => ($this->receiver->address !== null) ? $this->receiver->address : '-',
                'city' => ($this->receiver->city !== null) ? $this->receiver->city : '-',
                'province' => ($this->receiver->province !== null) ? $this->receiver->province : '-',
                'message' => ($this->receiver->message !== null) ? $this->receiver->message : '-',
                'NAMA' => ($this->receiver->name !== null) ? $this->receiver->name : '-',
                'SUBYEKDIBALAS' => ($this->receiver->message !== null) ? substr($this->receiver->message, 0, 50) : '-',
                'ISIKONTAK' => ($this->receiver->message !== null) ? substr($this->receiver->message, 0, 50) : '-',
                'replycontent' => ($this->receiver->reply_msg !== null) ? $this->receiver->reply_msg : '-',
                'subject' => ($this->template->subject !== null) ? substr($this->template->subject, 0, 50) : '-',
                'attachfile' => ($attachfile !== null) ? substr($attachfile, 0, 50) : '-',
            ]);

        // jika ada attchment file nya
        if ($attachfile) {
            return $this->from($this->template->from_email)
                ->subject($subject)
                ->attach($attachfile)
                ->view('mails.contactreply')
                ->with([
                    'bodyMessage' => $body,
                ]);
        } else {
            return $this->from($this->template->from_email)
                ->subject($subject)
                ->view('mails.contactreply')
                ->with([
                    'bodyMessage' => $body,
                ]);

        }
    }
}
