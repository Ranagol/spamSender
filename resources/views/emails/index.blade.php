@extends('layouts.master')
@section('title')
@section('content')

<table class="table">
  <tr>
    <th>Email</th>
    <th>Active</th>
    <th>Customer</th>
  </tr>
  <tr>
    @if(count($emails))
      @foreach($emails as $email)
        <td>{{ $email->email }}</td>
        <td>{{ $email->active }}</td>
        <td>{{ $email->customer}}</td>
      @endforeach
    @endif
  </tr>
</table>

@endsection
