@extends('layouts.master')
@section('title')
@section('content')

<div class="d-flex flex-row justify-content-around">
  <div>
    <h5>Add email one-by-one</h5>
    <form action="/emails" method="POST">
      @csrf
      <div class="form-group">
        <label for="email">Email address:</label>
        <input type="email" class="form-control" id="email" name="email">
      </div>

      <div class="form-group">
        <label for="customer">Customer:</label>
        <input type="customer" class="form-control" id="customer" name="customer" placeholder="Customer is optional...">
      </div>

      <button type="submit" class="btn btn-primary btn-sm">Submit</button>

    </form>

    


  </div>

  <div>
    <h5>Add multiple emails</h5>
    <form action="/multiple-emails" method="POST">
      @csrf
      <div class="form-group">
        <label for="textarea">Paste here the multiple emails:</label>
        <textarea class="form-control myTextArea" id="textarea" rows="12" name="stringWithEmails"></textarea>
      </div>

      <button type="submit" class="btn btn-primary btn-sm">Submit</button>

    </form>
  </div>
</div>

@if(Session::get('message') ?? '')
  <div class="alert alert-success" role="alert">
    {{ Session::get('message') ?? '' }}
  </div>
@endif

@include('layouts.errors')

@endsection