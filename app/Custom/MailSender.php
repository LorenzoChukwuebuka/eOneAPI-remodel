<?php

declare (strict_types = 1);

namespace App\Custom;

use App\Mail\Client\ClientForgetPasswordMail;
use App\Mail\Client\ClientVerifyAccountMail;
use App\Mail\User\UserCreditMail;
use App\Mail\User\UserForgetPasswordMail;
use App\Mail\User\UserVerifyAccountMail;
use App\Mail\Vendor\VendorForgetPasswordMail;
use App\Mail\Vendor\VendorVerifyAccountMail;
use Illuminate\Support\Facades\Mail;

class MailSender
{
    public static function verifyUserAccount(string $email, string | int $otp, string $username)
    {
        $mailData = ['token' => $otp, 'username' => $username];
        Mail::to($email)->send(new UserVerifyAccountMail($mailData));
    }

    public static function userForgetPassword(string $email, string $username, string | int $otp)
    {
        $mailData = ['token' => $otp, 'username' => $username];
        Mail::to($email)->send(new UserForgetPasswordMail($mailData));
    }

    public static function verifyVendorAccount(string $email, string | int $otp, string $businessname)
    {
        $mailData = ['token' => $otp, 'businessname' => $businessname];
        Mail::to($email)->send(new VendorVerifyAccountMail($mailData));
    }

    public static function vendorForgetPassword(string $email, string $username, string | int $token)
    {
        $mailData = ['token' => $token, 'businessname' => $username];

        Mail::to($email)->send(new VendorForgetPasswordMail($mailData));
    }

    public static function sendCreditMail(string $email, string $username, float | int $amount)
    {
        $mailData = ['username' => $username, 'amount' => $amount];
        Mail::to($email)->send(new UserCreditMail($mailData));
    }

    public static function verifyClientAccount(string $email, string | int $otp, string $businessname)
    {
        $mailData = ['token' => $otp, 'businessname' => $businessname];
        Mail::to($email)->send(new ClientVerifyAccountMail($mailData));
    }

    public static function clientForgetPassword(string $email, string $username, string | int $token)
    {
        $mailData = ['token' => $token, 'businessname' => $username];
        Mail::to($email)->send(new ClientForgetPasswordMail($mailData));

    }
}
