@extends('layouts.basic')

@section('content')
    <p>Genereer nieuwe tokens</p>
    <form action="{{ route('admin.tokens.update') }}" method="POST">
        @csrf
        <input type="tel" required minlength="1" maxlength="3" name="amount"/>
        <input type="submit" value="Generate"/>
    </form>
    <hr/>
    <ul class="uppercase font-mono">
        @foreach($tokens as $token)
            <li>{{ $token->token }}</li>
        @endforeach
    </ul>
@endsection
