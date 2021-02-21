@extends('layouts.voter')

@section('content')
    @include('components.token-banner')
    <voter-voting-page
        :initial-proposition='@json($proposition)'
        vote-route='{{ route('api.proposition.votes.store', ['proposition' => ':id']) }}'
    ></voter-voting-page>
@endsection
