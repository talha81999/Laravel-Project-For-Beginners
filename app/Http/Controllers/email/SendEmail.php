<?php

namespace App\Http\Controllers\email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Controller
{


public function index($recipient, $data)
{
    $user['to']         =       $recipient;
    $user['name']       =       $data['name'];
    $user['msg']        =       $data['message'];
    $user['password']   =       $data['password'];

    Mail::send('emails.email', $user, function($messages) use ($user) {
        $messages->to($user['to']);
        $messages->subject($user['name']);
    });
}
}
