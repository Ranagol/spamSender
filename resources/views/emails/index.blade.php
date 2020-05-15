@extends('layouts.master')
@section('title')
@section('content')

<h2>All emails</h2>

@if(count($emails))
  <div class="d-flex d-row justify-content-between">
    {{-- ALL EMAILS --}}
    <div>
      <p>Number of all emails: {{ count($emails) }}</p>
    </div>
    {{-- ACTIVE EMAILS --}}
    <div>
      <p>Number of active emails: {{ $countActiveEmails ?? '' }} </p>
    </div>
    {{-- SEARCH --}}
    <div>
      <form action="/findEmail" method="POST" class="form-inline my-2 my-lg-0">
        @csrf
        <input class="form-control mr-sm-2" type="search" name="findEmail" placeholder="Search">
        <button class="btn btn-outline-success my-2 my-sm-0 btn-sm" type="submit">Search</button>
      </form>
    </div>
  </div>
@endif



@include('layouts.errors')

<table class="table">
  <tr>
    <th>Email address</th>
    <th>Customer name</th>
    <th>Edit email or customer</th>
    <th>Active</th>
    <th>Change active to non-active</th>
  </tr>

  @if(count($emails))
    
    @foreach($emails as $email)
      <tr>
        {{-- EMAIL ADDRESS AND CUSTOMER NAME  --}}
        <form action="/emails/{{ $email->id }}" method="POST">
          @csrf
          @method('PUT')
          <td><input class="form-control" type="text" name="email" value="{{ $email->email }}"></td>
          <td><input class="form-control" type="text" name="customer" value="{{ $email->customer}}"></td>

          <td><button class="btn btn-outline-warning btn-sm">Edit</button></td>
        </form>

        {{-- ACTIVE STATUS WITH CHANGE BUTTON --}}
        <form action="/emails/{{ $email->id }}" method="POST">
          @csrf
          @method('PATCH')
          <td>{{ $email->active }}
            <p>
              <input type="text" hidden name="active" value="0">
            </p>
          </td>

          <td><button class="btn btn-outline-warning btn-sm">Change to non-active</button></td>
        </form>

      </tr>
      <!--TODO task for Andor: see below. -->
      {{-- Here I will have to put in a conditional new row for validation errors, for every row --}}
    @endforeach
  @endif

</table>



@endsection
