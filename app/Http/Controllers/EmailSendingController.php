<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Mail\MailForCustomers;
use App\Email;

class EmailSendingController extends Controller
{
    public function sendMultipleMails(){
        $customers = Email::where('active', true)->get();
        foreach ($customers as $customer) {
            Mail::to($customer->email)->send(new MailForCustomers());
        }
        $message = 'All emails were succesfully sent.';
        return view('/emails.send-email', compact('message'));
    }
}
