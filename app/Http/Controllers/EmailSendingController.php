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
        $customers = Email::where('active', true)->get();
        foreach ($customers as $customer) {
            Mail::to($customer->email)->send(new MailForCustomers());
            sleep(1);//this sleep is a bad practice. The issue I am awoiding with this sleep is only happening with free Mailtrap accounts, so I actually don't need a better solution, because I am moving to Mailgun soon.
            //https://stackoverflow.com/questions/35304197/laravel-email-with-queue-550-error-too-many-emails-per-second
        }
        $message = 'All emails were succesfully sent.';
        return view('/emailLaunching.send-email', compact('message'));
    }
}
