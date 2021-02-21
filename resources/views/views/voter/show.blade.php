@extends('layouts.voter')

@section('content')
    @include('components.token-banner')
    <voter-voting-page
        :initial-proposition='@json($proposition)'
        vote-route='{{ route('proposition.update') }}'
    ></voter-voting-page>
@endsection
