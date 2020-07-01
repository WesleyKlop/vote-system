@extends('layouts.admin')

@section('content')
    <div class="px-8 sm:px-0">
        <h1 class="title">Voter management</h1>
        <p class="mt-2 text-gray-600">
            On this page you can manage the tokens usable by voters.
        </p>
        <p class="">
            By generating new tokens you delete all existing ones, meaning all existing votes will be <span class="font-extrabold uppercase">removed</span>.
        </p>
        <form action="{{ route('admin.voters.update') }}" method="POST" class="my-4 flex flex-wrap items-end w-64">
            @csrf
            <label class="input-label inline-flex my-0 flex-1" for="amount">
                Amount of tokens
                <input
                    id="amount"
                    type="tel"
                    required
                    minlength="1"
                    maxlength="3"
                    size="3" name="amount" class="input rounded-r-none" placeholder="12"/>
            </label>
            <input type="submit" value="Generate" class="submit-button py-1 align-bottom my-0 -ml-1 rounded-l-none"/>
            @error('amount')
            <span class="text-failure text-sm font-normal w-full">{{ $message }}</span>
            @enderror
        </form>
        <hr/>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 py-6">
            @foreach($voters as $voter)
                <token-card v-bind='@json($voter)' delete-route="{{ route('admin.voters.destroy', $voter) }}" number="{{ $loop->iteration }}"></token-card>
            @endforeach
        </div>
    </div>
@endsection
