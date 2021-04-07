@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-24">
        <h1 class="title col-span-1 lg:col-span-2 px-8 sm:px-0 text-primary">@lang('Live')</h1>
        <div class="banner col-span-1 lg:col-span-2">{{ $welcomeMessage }}</div>

        <live-application-controls
            initial-proposition-id='{{ $currentPropositionId }}'
            :initial-propositions='@json($propositions)'
            :routes='@json([
                'update' => route('api.proposition.update', ':id'),
            ])'
        ></live-application-controls>
    </div>
@endsection
