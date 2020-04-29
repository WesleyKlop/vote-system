@extends('layouts.basic')

@section('content')
    <div class="border-b my-2 p-2">
        <h2>{{ $proposition->order }}. {{ $proposition->title }}</h2>
        <span>Is open: {{ $proposition->is_open ? 'yes' : 'no' }}</span>
        <div class="font-bold">Options</div>
        @if($proposition->type === 'list')
            <ul>
                @foreach($proposition->options as $option)
                    <li>{{ $option->option }}</li>
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
                @php($columns = $proposition->horizontalOptions()->count())
                @foreach($proposition->verticalOptions() as $option)
                    <tr>
                        <td class="border">{{ $option->option }}</td>
                        @for($i = 0; $i < $columns; $i++)
                            <td class="border"></td>
                        @endfor
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
