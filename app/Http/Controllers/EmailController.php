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
        $emails = Email::all();
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
            'customer' => 'max:40',//TODO how to validate this? This could be sometimes null. But when it is not null, the max character number should not be more than 40
        ]);
        
        $email = new Email();
        $email->email = $request->email;
        $email->active = true;//TODO this could be a possible error here, be careful
        $email->customer = $request->customer;
        $email->save();
        $message = 'The ' . $request->email . ' has been saved to database.';
        return view('emails.create', compact('message'));
    }

    public function storeMultiple(Request $request){
        // TODO ok, here i need help. I am sending some gibberish string to this method, and some shitty validation method is not alowing me to proceed. How turn this shit off?
        $stringWithEmails = $request->stringWithEmails;
        $emailArray = $this->extract_emails_from($stringWithEmails);
        dd($emailArray);
    }

    public function extract_emails_from($string){
        preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $matches);
        return $matches[0];
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
    public function update(Request $request, Email $email)
    {
        //
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
