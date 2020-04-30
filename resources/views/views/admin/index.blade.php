@extends('layouts.basic')

@section('content')
    @foreach($page->getPropositions() as $proposition)
        <div class="border p-4 -mb-px">
            <h2 class="text-3xl border-b">{{ $proposition->order }}. {{ $proposition->title }}</h2>
            <span>Is open: {{ $proposition->is_open ? 'yes' : 'no' }}</span>
            @if($proposition->type === 'list')
                <h3 class="text-xl">{{ $page->getListQuestion($proposition)->option }}</h3>
                <ul>
                    @foreach($page->getListOptions($proposition) as $option)
                        <li>{{ $option->option }}: {{ $page->getOptionCount($proposition, $option) }}</li>
                    @endforeach
                </ul>
            @elseif($proposition->type === 'grid')
                <table>
                    <thead>
                    <th class="border"></th>
                    @foreach($proposition->horizontalOptions() as $option)
                        <th class="border">{{ $option->option }}</th>
                    @endforeach
                    </thead>
                    <tbody>
                    @foreach($proposition->verticalOptions() as $rowOption)
                        <tr>
                            <td class="border">{{ $rowOption->option }}</td>
                            @foreach($proposition->horizontalOptions() as $colOption)
                                <td class="border">{{ $page->getOptionCount($proposition, $rowOption, $colOption) }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endforeach
@endsection
