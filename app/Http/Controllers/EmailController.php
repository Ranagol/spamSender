<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$emails = Email::all();
        $emails = Email::orderBy('created_at', 'DESC')->get();
        return view('emails.index', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('emails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            $email = new Email();
            $email->email = $singleEmail;
            $email->save();
        }
        $message = count($emailArray) . ' emails have been saved to the database.';
        return view('emails.create', compact('message'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
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
        return view('emails.index', compact('emails'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        //
    }
}
