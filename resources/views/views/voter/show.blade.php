@extends('layouts.basic')

@section('content')
    @php($proposition = $page->getProposition())
    <form class="border-b my-2 p-2" method="POST" action="{{ route('proposition.update') }}">
        @csrf
        <input type="hidden" name="proposition" value="{{ $proposition->id }}"/>
        <h2 class="text-3xl border-b">{{ $proposition->order }}. {{ $proposition->title }}</h2>
        @if($page->isType('list'))
            <h3 class="text-xl font-bold">{{ $page->getListQuestion()->option }}</h3>
            <div>
                @foreach($page->getListOptions() as $option)
                    <label class="block">
                        <input type="radio" name="answer[{{ $page->getListQuestion()->id }}]" value="{{ $option->id }}"/>
                        {{ $option->option }}
                    </label>
                @endforeach
            </div>
        @elseif($page->isType('grid'))
            <div class="max-w-screen overflow-x-scroll">
                <table class="table-auto">
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
                                <td class="border">
                                    <input type="radio" name="answer[{{ $rowOption->id }}]" value="{{ $colOption->id }}"/>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <input type="submit"/>
    </form>
@endsection
