@extends('layouts.basic')

@section('content')
    <form action="{{ route('index.register') }}" method="POST">
        @csrf

        <input
            title="Token"
            type="text"
            maxlength="16"
            name="token"
            autocomplete="off"
            autocorrect="off"
            autocapitalize="off"
            spellcheck="false"
            placeholder="Enter token..."
        />

        <input type="submit" value="Start"/>
    </form>
@endsection
