@extends('layouts.basic')

@section('content')
    <p>Genereer nieuwe tokens</p>
    <form action="{{ route('admin.voters.update') }}" method="POST">
        @csrf
        <input type="tel" required minlength="1" maxlength="3" name="amount"/>
        <input type="submit" value="Generate"/>
    </form>
    <hr/>
    <ol class="uppercase font-mono list-decimal list-inside">
        @foreach($voters as $voter)
            <li>{{ $voter->token }}</li>
        @endforeach
    </ol>
@endsection
