<?php

namespace App\Console\Commands;

use App\Mail\SendNewsletterMail;
use App\Models\NewsLetterContent;
use App\Models\NewsLetterMember;
use App\Models\NewsLetterQueue;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NewsLetterModuleSendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengirimkan Email News Letter ke Anggota';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
                // You are now Tenant Aware
        // Execute something, dispatch a Job, or anything else
        $contents = NewsletterContent::where('publish', 1)->where('queue', '>', 0)->inRandomOrder()->limit(1)->get();

        foreach ($contents as $content) {
            $queue = $content->queue;
            $queueemail = $content->email;

            // cari queue nya
            $queues = NewsletterQueue::where('content_id', $content->id)->limit(10)->get();
     
            foreach ($queues as $queue) {
                if ($queue->email != null) {
                    $this->info("Cron is working fine! NewsletterModuleSendCommand EMAIL TO " . $queue->email);

                    if ($queue->email) {
                        
                        try {
                            
                            $pendaftar = NewsLetterMember::where('email', $queue->email)->first();
                            Mail::to($queue->email)->send(new SendNewsletterMail($content, $pendaftar));

                            $this->info("Cron is working fine! NewsletterModuleSendCommand SUCCESS MAIL " . $queue->email);

                            NewsLetterContent::find($content->id)->increment('sent');
                            NewsletterContent::find($content->id)->decrement('queue');

                        } catch (\Exception $e) {
                            report($e);

                            $this->info("Cron is working fine! NewsletterModuleSendCommand FAILED MAIL " . $queue->email);

                            NewsletterContent::find($content->id)->increment('failed');
                            NewsletterContent::find($content->id)->decrement('queue');

                            // return false;
                        }

                        // delete queue
                        NewsLetterQueue::find($queue->id)->delete();
                    }
                }
            }
        }
    }
}
