<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;
use Mail;

class everyDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will send data daily';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $adminsMail = Admin::select('email')->get();
        $emails = [];
        foreach($adminsMail as $mail){
            $emails[] = $mail['email'];
        }

        Mail::send('emails.morningdetails', [],function($message) use($emails){
            $message->to($emails)->subject('Following Approvals are left for verification');
        });
    }
}