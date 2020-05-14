@extends('layouts.master')
@section('title')
@section('content')
    <h4>Trigger email sending</h4>
    
    <p>Send multiple mails to mailtrap, to all email adresses from the db:</p>
    <form action="/send-multiple-emails" method="GET">
        <button type="submit" class="btn btn-outline-success btn-sm">Send mail</button>
    </form>
    <p></p>

    <h4>Download email addresses in excel</h4>
    <p>Here you can get all your email addresses from the db, in excel sheet.</p>
    <form action="/getExcel" method="GET">
        <button type="submit" class="btn btn-outline-success btn-sm">Get excel</button>
    </form>
    <p></p>

    <h4>Upload email adresses from excel</h4>
    <p>Here you can upload your previouly exported email address (backup/reset)</p>
    <form action="/uploadExcel" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="myFile" >
        <button type="submit" class="btn btn-outline-info btn-sm">Upload</button>
    </form>
    <p></p>

@if($message ?? '')
    <div class="alert alert-success" role="alert">
        {{ $message ?? '' }}
    </div>
@endif

@include('layouts.errors')
@endsection