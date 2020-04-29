@extends('layouts.basic')

@section('content')
    <pre>@json(session()->all(), JSON_PRETTY_PRINT)</pre>
    <form action="{{ route('admin.login.update') }}" method="POST">
        @csrf

        <input type="name" name="name" autocomplete="username"/>
        <input type="password" name="password" autocomplete="current-password"/>

        <input type="submit"/>
    </form>
@endsection
