@extends('layouts.master')
@section('title')
@section('content')

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
        <form action="/emails/{{ $email->id }}">
          @csrf
          @method('PATCH')
          <td><input class="form-control" type="text" name="email" value="{{ $email->email }}"></td>
          <td><input class="form-control" type="text" name="customer" value="{{ $email->customer}}"></td>

          <td><button class="btn btn-warning">Edit</button></td>
        </form>

        <form action="/emails/{{ $email->id }}" method="POST">
          @csrf
          @method('PATCH')
          <td>{{ $email->active }}
            <span>
              <input type="text" hidden name="active" value="0">
            </span>
          </td>

          <td><button class="btn btn-warning">Change to non-active</button></td>
        </form>

      </tr>
      {{-- Here I will have to put in a conditional new row for errors, for every row --}}
    @endforeach
  @endif

</table>



@endsection
