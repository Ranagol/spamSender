<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Mail\MailForCustomers;
use App\Email;

class EmailSendingController extends Controller
{
    public function sendMail(){
        $name = 'ReceiverClient';
        Mail::to('receiverClient@gmail.com')->send(new SendMailable($name));
        $message = 'Email was succesfully sent.';
        return view('/emailLaunching.send-email', compact('message'));
    }

    public function sendMultipleMails(){
        //get all active email addresses from db to an array
        $customers = Email::where('active', true)->get();
        foreach ($customers as $customer) {
            Mail::to($customer->email)->send(new MailForCustomers());
        }
        $message = 'All emails were succesfully sent.';
        return view('/emailLaunching.send-email', compact('message'));
    }
}
