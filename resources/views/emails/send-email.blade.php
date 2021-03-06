@extends('layouts.master')
@section('title')
@section('content')
    <h4>Email sending</h4>
    
    <p>Send an email to all contacts - think twice, check twice before that :) </p>
    <form action="/send-multiple-emails" method="GET">
        <button type="submit" class="btn btn-outline-danger btn-sm">Send mail</button>
    </form>
    <p></p>


@if($message ?? '')
    <div class="alert alert-success" role="alert">
        {{ $message ?? '' }}
    </div>
@endif

@include('layouts.errors')
@endsection