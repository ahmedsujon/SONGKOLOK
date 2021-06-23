<?php

namespace App\Http\Controllers;

use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public static function sendVerificationMail($name, $email, $verification_code)
    {
        $data = [
            'name' => $name,
            'verification_code' => $verification_code
        ];
        Mail::to($email)->send(new VerificationMail($data));
    }
}
