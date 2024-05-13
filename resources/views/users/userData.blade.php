@extends('layouts.main')

@section('content')
    <h1 class="text-3xl font-bold underline">
        Users
    </h1>

    @foreach ($users as $user)
        <p>The entire table {{$user}}</p>
        <br>
        <p>Nombre de usuario: {{$user->name}}</p>
        <p>Email: {{$user->email}}</p>
    @endforeach
@endsection
