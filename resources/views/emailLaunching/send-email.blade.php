@extends('layouts.master')
@section('title')
@section('content')
    <h4>Trigger email sending</h4>
    <p>Send one test mail to one fix address in mailtrap:</p>
    <form action="/send-email" method="GET">
        <button type="submit" class="btn btn-success">Send mail</button>
    </form>

    <p></p>

    <p>Send multiple mails to mailtrap, to all email adresses from the db:</p>
    <form action="/send-multiple-emails" method="GET">
        <button type="submit" class="btn btn-success">Send mail</button>
    </form>

@if($message ?? '')
    <div class="alert alert-success" role="alert">
        {{ $message ?? '' }}
    </div>
@endif

@include('layouts.errors')
@endsection