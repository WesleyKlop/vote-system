@extends('layouts.basic')

@section('content')
    <form class="border-b my-2 p-2" method="POST" action="{{ route('proposition.update') }}">
        @csrf
        <input type="hidden" name="proposition" value="{{ $proposition->id }}"/>
        <h2>{{ $proposition->order }}. {{ $proposition->title }}</h2>
        <div class="font-bold">Options</div>
        @if($proposition->type === 'list')
            <div>
                @foreach($proposition->options as $option)
                    <label class="block">
                        <input type="radio" name="answer" value="{{ $option->id }}"/>
                        {{ $option->option }}
                    </label>
                @endforeach
            </div>
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
                        @foreach($proposition->horizontalOptions() as $horOption)
                            <td class="border">
                                <input type="radio" name="answer[{{ $rowOption->id }}]" value="{{ $horOption->option }}"/>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        <input type="submit"/>
    </form>
@endsection
