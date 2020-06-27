@extends('layouts.voter')

@section('content')
    <p class="banner whitespace-pre">{!! $welcomeMessage !!}</p>
    <form action="{{ route('voter.login') }}" method="POST" class="px-8 sm:px-0">
        @csrf
        <label class="input-label w-64 mb-1">
            Token
            <token-input value="{{ old('token') }}" :errors='@json($errors->get('token'))'></token-input>
        </label>
        <p class="mb-2 text-gray-900">
            The token can contain all letters and numbers except for: <span class="font-mono text-sm">0, 1, I, L, O</span>
        </p>

        <input type="checkbox" name="legal_accepted" class="checkbox-input" hidden id="legal_accepted"/>
        <label class="checkbox-input-label items-baseline flex-wrap {{ $errors->has('legal_accepted') ? 'checkbox-input--invalid' : '' }}" for="legal_accepted">
            <span class="checkbox-input-text leading-tight text-sm whitespace-pre">{!! $voterLegalRequirements !!}</span>
            @error('legal_accepted')
            <span class="text-failure text-sm w-full">Accepting the terms is required.</span>
            @enderror
        </label>


        <input type="submit" value="Start" class="submit-button"/>
    </form>
@endsection
