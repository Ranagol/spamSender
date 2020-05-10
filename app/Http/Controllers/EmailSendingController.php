<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class EmailSendingController extends Controller
{
    //I am using this article for gmail sending
    //https://medium.com/@agavitalis/how-to-send-an-email-in-laravel-using-gmail-smtp-server-53d962f01a0c
    protected $to_email = 'andorhorvat@gmail.com';
    protected $to_name = 'Andor Horvat';
    protected $data = [
        'name'=>"Vodor Odon(sender_name)",
        "body" => "A test mail"
    ];

    public function sendMail(){
        Mail::send('emailSending.mail', $this->data, function($message) {
            $message->to($this->to_email, $this->to_name)->subject('Laravel Test Mail');
            $message->from('makitabecej@gmail.com','Test Mail');
        });
        $message = 'Email has been sent';
        return view('sending.send-email', compact('message'));
    }
    

    
}
