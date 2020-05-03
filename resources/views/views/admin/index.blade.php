@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-24">
        <h1 class="title col-span-1 lg:col-span-2 px-8 sm:px-0">Dashboard</h1>
        <p class="banner col-span-1 lg:col-span-2">
            Total voter count: <span class="font-bold">{{ $page->getTotalVoterCount() }}</span> | Used: <span class="font-bold">{{ $page->getUsedVoterCount() }}</span><br/>
            These statistics are based on the <span class="font-bold">used</span> tokens.
        </p>
        @foreach($page->getPropositions() as $proposition)
            <div class="card">
                <div class="card-header">
                    <h2 class="title flex-1 truncate">{{ $proposition->order }}. {{ $proposition->title }}</h2>
                    <span class="badge">{{ $proposition->is_open ? 'open' : 'closed' }}</span>
                </div>

                <div class="card-content">
                    @if($proposition->type === 'list')
                        <h3 class="sub-title">{{ $page->getListQuestion($proposition)->option }}</h3>
                        @foreach($page->getListOptions($proposition) as $option)
                            @php
                                $count = $page->getOptionCount($proposition, $option);
                                $width = $count / ($page->getUsedVoterCount() ?: 1)
                            @endphp
                            <div class="w-3/4 relative h-8 rounded border-2 border-gray-300 overflow-hidden my-2">
                                <div class="mr-auto bg-gray-200 absolute left-0 inset-y-0" style="width: {{ $width * 100 }}%"></div>
                                <div class="z-10 leading-5 absolute px-2 py-1 left-0 inset-y-0">{{ $option->option }}: {{$count}} ({{ round($width * 100) }}%)</div>
                            </div>
                        @endforeach
                    @elseif($proposition->type === 'grid')
                        <div class="table-wrapper">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    @foreach($proposition->horizontalOptions() as $option)
                                        <th>{{ $option->option }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($proposition->verticalOptions() as $rowOption)
                                    <tr>
                                        <th>{{ $rowOption->option }}</th>
                                        @foreach($proposition->horizontalOptions() as $colOption)
                                            <td>{{ $page->getOptionCount($proposition, $rowOption, $colOption) }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.propositions.edit', $proposition) }}" class="card-footer-link">Edit</a>
                    <a href="{{ route('admin.propositions.toggle', [
                        'proposition' => $proposition,
                        'is_open' => ! $proposition->is_open
                        ]) }}"
                       class="card-footer-link"
                    >
                        {{ $proposition->is_open ? 'Close' : 'Open' }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <a
        class="fixed bottom-0 right-0 rounded-full bg-gray-500 m-4 sm:m-8 p-2 w-16 h-16 sm:w-20 sm:h-20 shadow-lg"
        href="{{ route('admin.propositions.create') }}"
        title="Create proposition"
    >
        <svg viewBox="0 0 24 24" class="w-full h-full text-white">
            <path fill="currentColor" fill-rule="evenodd" d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/>
        </svg>
    </a>
@endsection
