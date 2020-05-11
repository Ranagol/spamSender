<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class EmailSendingController extends Controller
{
    public function sendMail(){
        $name = 'ReceiverClient';
        Mail::to('receiverClient@gmail.com')->send(new SendMailable($name));
        $message = 'Email was succesfully sent.';
        return view('/emailLaunching.send-email', compact('message'));
    }
}
