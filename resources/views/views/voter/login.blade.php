@extends('layouts.voter')

@section('content')
    <p class="banner">
        Welcome to this voting application! Please enter the token you've been given to start.
        The token can contain all letters and numbers except for: <span class="font-mono text-sm">0, 1, I, L, O</span>
    </p>
    <form action="{{ route('voter.login') }}" method="POST" class="px-8 sm:px-0">
        @csrf
        <label class="input-label w-64">
            Token
            <token-input></token-input>
        </label>

        <input type="submit" value="Start" class="submit-button"/>
    </form>
@endsection
