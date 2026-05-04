@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/pages.css') }}">


<h1 class="mb-4">Messages reçus</h1>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Sujet</th>
            <th>Message</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>
        @foreach($messages as $msg)
        <tr>
            <td>{{ $msg->id }}</td>
            <td>{{ $msg->email }}</td>
            <td>{{ $msg->sujet }}</td>
            <td>{{ $msg->message }}</td>
            <td>{{ $msg->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection