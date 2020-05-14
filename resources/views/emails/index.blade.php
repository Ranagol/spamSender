@extends('layouts.master')
@section('title')
@section('content')

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
    <span>Numer of emails: {{ count($emails) }}</span>
    @foreach($emails as $email)
      <tr>
        {{-- EMAIL AND CUSTOMER  --}}
        <form action="/emails/{{ $email->id }}" method="POST">
          @csrf
          @method('PUT')
          <td><input class="form-control" type="text" name="email" value="{{ $email->email }}"></td>
          <td><input class="form-control" type="text" name="customer" value="{{ $email->customer}}"></td>

          <td><button class="btn btn-outline-warning btn-sm">Edit</button></td>
        </form>

        {{-- ACTIVE STATUS --}}
        <form action="/emails/{{ $email->id }}" method="POST">
          @csrf
          @method('PATCH')
          <td>{{ $email->active }}
            <span>
              <input type="text" hidden name="active" value="0">
            </span>
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
