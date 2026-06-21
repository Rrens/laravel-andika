<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function send_email()
    {
        $data = [
            'subject' => 'Dari andika',
            'name' => 'andika',
            'body' => 'Testing Email dari andika',
        ];

        $user_email = auth()->user()->email;

        // Mail::to('rendy@gmail.com')
        $send_email = Mail::to($user_email)->send(new SendEmail($data));

        dd('Email Berhasil dikirim', $send_email);
    }
}
