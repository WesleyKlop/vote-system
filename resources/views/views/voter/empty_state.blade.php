@extends('layouts.voter')

@section('content')
    @include('components.token-banner')
    @include('components.error-banner', ['error' => 'proposition'])

    <div class="text-center px-4 sm:px-0">There is currently no proposition for you to answer</div>
@endsection
