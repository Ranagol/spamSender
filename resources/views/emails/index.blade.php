@extends('layouts.master')
@section('title')
@section('content')

<table class="table">
  <tr>
    <th>Email</th>
    <th>Active</th>
    <th>Customer</th>
  </tr>

  @if(count($emails))
    @foreach($emails as $email)
      <tr>
        <td>{{ $email->email }}</td>
        <td>{{ $email->active }}</td>
        <td>{{ $email->customer}}</td>
      </tr>
    @endforeach
  @endif

</table>

@endsection
