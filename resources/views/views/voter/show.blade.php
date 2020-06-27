@extends('layouts.voter')

@section('content')
    @php($proposition = $page->getProposition())
    @include('components.token-banner')
    @include('components.error-banner', ['error' => 'proposition'])
    <form class="my-2 p-2 w-full lg:w-3/4" method="POST" action="{{ route('proposition.update') }}">
        @csrf
        <input type="hidden" name="proposition" value="{{ $proposition->id }}" required/>
        <span class="text-gray-600">Proposition {{ $proposition->order }}</span>
        <h2 class="title mb-6">{{ $proposition->title }}</h2>

        @include('components.proposition-options-' . $proposition->type)

        <input type="submit" class="submit-button" value="Vote"/>
    </form>
@endsection
