<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exports\EmailExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmailImport;
use Carbon\Carbon;

class EmailController extends Controller
{
    public function index(Request $request)
    {
        //1 part
        if ($request->findEmail) {
            $searchTerm = $request->findEmail;
            $emails = Email::where('email', 'like', '%' . $searchTerm . '%')
                ->orWhere('customer', 'like', '%' . $searchTerm . '%');//there is no ->get() here at the end of this line, so this is not executed, just created. Execution will happen later...
        } else {
            $emails = new Email();
        }
        //if ore else: both of them are returning an $emails, that contains the Email model. Whichever happens, the 2 part can work with it.

        //2 part
        $emails = $emails->orderBy('created_at', 'DESC')->get();//... and here we have the ->get execution
        $countActiveEmails = Email::where('active', true)->count();
        return view('emails.index', compact('emails', 'countActiveEmails'));
    }

    
    public function create()
    {
        return view('emails.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:40|unique:emails',
            'customer' => 'max:40',
        ]);
        
        $email = new Email();
        $email->email = $request->email;
        $email->customer = $request->customer;
        $email->save();

        $message = 'The ' . $request->email . ' has been saved to database.';
        //https://laravel.com/docs/7.x/session#flash-data
        $request->session()->flash('message', $message);//flash, because the next request will delete this message, so it will be used once, and it will be deleted after that. 'message' = our blade is expecting a $message. $message = is the text that we want to display.
        return redirect()->action('EmailController@create');//our blade will be called with create method, and will display this flash session message once, after the message will disappear
    }

    public function storeMultiple(Request $request){
        $stringWithEmails = $request->stringWithEmails;
        $emailArray = Email::extract_emails_from($stringWithEmails);//extract all emails from the gibberish text
        $now = Carbon::now();//with this method, the created_at and updated_at fields won't be filled, so we have to do this manually. $now will be used for this. Email::insert can ony work with arrays in arrays. So we will work with a $emails[][].
        $emails = [];
        foreach ($emailArray as $email) {
            $emails[] = [
                'email' => $email,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        Email::insert($emails);
        
        $message = count($emailArray) . ' emails have been saved to the database.';
        $request->session()->flash('message', $message);
        return redirect()->action('EmailController@create');
    }

   
    public function update(Request $request, $id)
    {
        //TODO the email and the customer must be in separated form fields! They can't be edited and updated together, because the email has unique validation controll, and it will create a problem when the customer is changed and the email is not. 
        
        $request->validate([
            'email' => 'required|string|max:40|unique:emails',
            'customer' => 'max:40',
        ]);
        
        $email = Email::find($id);
        $email->email = $request->email;
        $email->customer = $request->customer;
        $email->save();
        $emails = Email::orderBy('created_at', 'DESC')->get();
        return view('emails.index', compact('emails'));  
    }

    public function updateActive(Request $request, $id){
        $email = Email::find($id);
        $email->active = false;
        $email->save();
        return redirect()->action('EmailController@index');//here we use redirect to activate the index method after a succesfull update, to get all new (updated, edited) emails
    }

    public function getExcel()
    {
        return Excel::download(new EmailExport, 'emails.xlsx');
    }

    public function uploadExcel(Request $request){

        //<!--TODO task for Andor: see below. -->
        //validate for excel, not bigger than 2Mb

        Excel::import(new EmailImport, $request->myFile);
        $message = 'Your file was succesfully uploaded';
        return view('/emailLaunching.send-email', compact('message'));
    }

    

    
}
