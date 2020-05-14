<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;
use App\Exports\EmailExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmailImport;

class EmailController extends Controller
{
    
    public function index()
    {
        //$emails = Email::all();
        $emails = Email::orderBy('created_at', 'DESC')->get();
        return view('emails.index', compact('emails'));
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
        return view('emails.create', compact('message'));
    }

    public function storeMultiple(Request $request){
        $stringWithEmails = $request->stringWithEmails;
        $emailArray = Email::extract_emails_from($stringWithEmails);
        foreach ($emailArray as $singleEmail) {
            
            //TODO how to validate a simple string in a simple variable? I must check for duplication, before writing the email adress to the db.
            //Sometimes you may wish to stop running validation rules on an attribute after the first validation failure. To do so, assign the bail rule to the attribute:

            $email = new Email();
            $email->email = $singleEmail;
            $email->save();
        }
        $message = count($emailArray) . ' emails have been saved to the database.';
        return view('emails.create', compact('message'));
    }

   
    public function update(Request $request, $id)
    {
        //TODO this validation randomly makes shit. customer name sometimes can't be number. Customer name sometimes can't be changed, edited. 
        /*
        $request->validate([
            'email' => 'required|string|max:40|unique:emails',
            'customer' => 'max:40',
        ]);
        */
        
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
        $emails = Email::orderBy('created_at', 'DESC')->get();
        return view('emails.index', compact('emails'));//TODO this is the way how I refresh the page with the updated data. Is this OK?
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
