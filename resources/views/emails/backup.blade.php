@extends('layouts.master')
@section('title')
@section('content')

    <h4>Download email addresses in excel</h4>
    <p>Here, with the "Get excel" button you can get all your email addresses from the db, in an excel sheet. You can use this for backup.</p>
    <form action="/getExcel" method="GET">
        <button type="submit" class="btn btn-outline-success btn-sm">Get excel</button>
    </form>
    <p></p>

    <h4>Upload email adresses from excel</h4>
    <p>With the "Upload" button you can upload back your email adresses from an excel file. It is assumed that you will use a previously dowloaded excel file.</p>
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