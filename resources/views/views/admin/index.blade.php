@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 py-8">
        <p class="bg-gray-100 col-span-1 lg:col-span-2 p-8 py-2 sm:rounded-lg text-lg">
            Total voter count: <span class="font-bold">{{ $page->getVoterCount() }}</span>
        </p>
        @foreach($page->getPropositions() as $proposition)
            <div class="sm:rounded-lg shadow col-span-1 flex flex-col justify-between">
                <div class="flex justify-between items-center px-8 py-4">
                    <h2 class="text-3xl leading-8 truncate flex-1">{{ $proposition->order }}. {{ $proposition->title }}</h2>
                    <span class="text-sm rounded-full px-4 py-1 my-1 leading-4 bg-gray-200 uppercase font-bold">{{ $proposition->is_open ? 'open' : 'closed' }}</span>
                </div>

                <div class="px-8 py-4">
                    @if($proposition->type === 'list')
                        <h3 class="text-xl">{{ $page->getListQuestion($proposition)->option }}</h3>
                        @foreach($page->getListOptions($proposition) as $option)
                            @php
                                $count = $page->getOptionCount($proposition, $option);
                                $width = $count / $page->getVoterCount()
                            @endphp
                            <div class="w-3/4 relative h-8 rounded border-2 border-gray-300 overflow-hidden my-2">
                                <div class="mr-auto bg-gray-200 absolute left-0 inset-y-0" style="width: {{ $width * 100 }}%"></div>
                                <div class="z-10 leading-5 absolute px-2 py-1 left-0 inset-y-0">{{ $option->option }}: {{$count}} ({{ round($width * 100) }}%)</div>
                            </div>
                        @endforeach
                    @elseif($proposition->type === 'grid')
                        <div class="border-gray-300 rounded-lg overflow-x-auto border-collapse">
                            <table class="table-auto w-full">
                                <thead class="border-b border-gray-200">
                                <tr>
                                    <th class="px-2 py-1"></th>
                                    @foreach($proposition->horizontalOptions() as $option)
                                        <th class="px-2 py-1">{{ $option->option }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($proposition->verticalOptions() as $rowOption)
                                    <tr class="{{ $loop->even ? 'bg-gray-100' : '' }}">
                                        <th class="px-2 py-1">{{ $rowOption->option }}</th>
                                        @foreach($proposition->horizontalOptions() as $colOption)
                                            <td class="px-2 py-1">{{ $page->getOptionCount($proposition, $rowOption, $colOption) }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <div class="border-t border-gray-300 flex justify-end px-8 py-4 mt-4">
                    <a href="{{ route('admin.propositions.toggle', [
                        'proposition' => $proposition,
                        'is_open' => ! $proposition->is_open
                        ]) }}"
                       class="uppercase font-bold text-md text-gray-900 px-2 py-px rounded hover:bg-gray-200"
                    >
                        {{ $proposition->is_open ? 'Close' : 'Open' }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
