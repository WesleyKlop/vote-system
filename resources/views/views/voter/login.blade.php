@extends('layouts.voter')

@section('content')
    <p class="banner">{!! $welcomeMessage !!}</p>
    <form action="{{ route('voter.login') }}" method="POST" class="px-8 sm:px-0">
        @csrf
        <label class="input-label w-64 mb-1">
            @lang('Token')
            <token-input initial-value="{{ old('token') }}" :errors='@json($errors->get('token'))'></token-input>
        </label>
        <p class="mb-2 text-gray-900">@lang('Token validation information')</p>

        <x-form.checkbox name='legal_accepted' :label='$voterLegalRequirements' />

        <input type="submit" value="Start" class="submit-button" />

        <ill-vote class='w-full p-8 max-w-xl mx-auto md:p-16' />
    </form>
@endsection
