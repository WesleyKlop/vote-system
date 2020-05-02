@extends('layouts.voter')

@section('content')
    @php($proposition = $page->getProposition())
    <form class="border-b my-2 p-2" method="POST" action="{{ route('proposition.update') }}">
        @csrf
        <input type="hidden" name="proposition" value="{{ $proposition->id }}"/>
        <span class="text-gray-600">Proposition {{ $proposition->order }}</span>
        <h2 class="title mb-6">{{ $proposition->title }}</h2>

        @include('components.proposition-options-' . $proposition->type)

        <input type="submit" class="submit-button" value="Vote"/>
    </form>
@endsection
