<?php

declare (strict_types = 1);

namespace App\Custom;

use App\Mail\User\UserVerifyAccountMail;
use Illuminate\Support\Facades\Mail;

class MailSender
{
    public static function verifyUserAccount(string $email, string | int $otp, string $username)
    {
        $mailData = ['token' => $otp, 'username' => $username];
        Mail::to($email)->send(new UserVerifyAccountMail($mailData));
    }

    public static function userForgetPassword(string $email, string | int $otp)
    {

    }

    public static function verifyClientAccount()
    {}
}
