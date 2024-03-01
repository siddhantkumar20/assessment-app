<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;
use App\Models\Approval;
use App\Models\ApprovalStudent;
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

    // $data = [["email"=>"test1@gmail.com"],["email"=>"test2@gmail.com"],["email"=>"test3@gmail.com"]];

    $teachers = Approval::all();
    $students = ApprovalStudent::all();

    $data = [];
    foreach ($teachers as $teacher) {
        $data[] = ["name" => $teacher->name, "email" => $teacher->email, "role" => "teacher"];
    }

    foreach ($students as $student) {
        $data[] = ["name" => $student->name, "email" => $student->email, "role" => "student"];
    }

    Mail::send('emails.morningdetails', ['data'=>$data],function($message) use($emails){
    $message->to($emails)->subject('Following Approvals are left for verification');
        });
    }
}