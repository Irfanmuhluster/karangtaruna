<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content, $pendaftar)
    {
        $this->content = $content;
        $this->pendaftar = $pendaftar;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /**
         * proses menentukan tema publik yang aktif yg mana, hanya bisa ambil langsung dari database
         */

        return $this
            ->from($this->content->from_email, $this->content->from_name)
            ->view("mails.newsletter")
            ->with([
                'bodyMessage' => $this->content->content,
                'from_name' => $this->content->from_name,
                'unsubscribe_url' => route('newsletter.unsubscribe', ['id' => $this->pendaftar->id, 'encriptmail' => md5($this->pendaftar->email)])
            ])
            ->subject($this->content->subject);
    }
}
