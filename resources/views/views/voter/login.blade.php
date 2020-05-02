@extends('layouts.voter')

@section('content')
    <form action="{{ route('voter.login') }}" method="POST" class="">
        @csrf
        <label class="input-label w-64">
            Token
            <token-input></token-input>
        </label>

        <input type="submit" value="Start" class="submit-button"/>
    </form>
@endsection
