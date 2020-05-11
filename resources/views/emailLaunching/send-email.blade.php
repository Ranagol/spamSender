@extends('layouts.master')
@section('title')
@section('content')
    <h4>Trigger email sending</h4>
    <p>Send mail to mailtrap:</p>
    <form action="/send-email" method="GET">
        <button type="submit" class="btn btn-success">Send mail</button>
    </form>

@if($message ?? '')
    <div class="alert alert-success" role="alert">
        {{ $message ?? '' }}
    </div>
@endif

@include('layouts.errors')
@endsection