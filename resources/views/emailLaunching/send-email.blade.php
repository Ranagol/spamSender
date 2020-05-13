@extends('layouts.master')
@section('title')
@section('content')
    <h4>Trigger email sending</h4>
    
    <p>Send multiple mails to mailtrap, to all email adresses from the db:</p>
    <form action="/send-multiple-emails" method="GET">
        <button type="submit" class="btn btn-success">Send mail</button>
    </form>
    <p></p>

    <h4>Get email addresses in excel</h4>
    <p>Here you can get all your email addresses from the db, in excel sheet</p>
    <form action="/getExcel" method="GET">
        <button type="submit" class="btn btn-success">Get excel</button>
    </form>

@if($message ?? '')
    <div class="alert alert-success" role="alert">
        {{ $message ?? '' }}
    </div>
@endif

@include('layouts.errors')
@endsection