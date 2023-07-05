<?php

namespace App\Custom;

use Illuminate\Support\Facades\Mail;

class MailSender
{
    public static function verifyUserAccount()
    {
        $mailData = [];
        Mail::to('your_email@gmail.com')->send(new DemoMail($mailData));
    }

    public static function userForgetPassword(){}


    public static function verifyClientAccount(){}
}
