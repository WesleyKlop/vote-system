@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('admin.propositions.store') }}" class="flex flex-col items-stretch px-8 sm:px-0 w-full lg:w-3/4">
        <h1 class="title">Create proposition</h1>
        @csrf

        <div class="">
            <label class="input-label">
                Title
                <input type="text" required name="title" value="{{ old('title') }}" class="input" placeholder="Is it okay to put pineapple on pizza?"/>
                @error('title')
                <span class="text-failure text-sm font-normal">{{ $message }}</span>
                @enderror
            </label>

            <label class="input-label">
                Order
                <input type="number" min="1" name="order" class="input" placeholder="1" value="{{ old('order', $nextPropositionOrder) }}"/>
                @error('order')
                <span class="text-failure text-sm font-normal">{{ $message }}</span>
                @enderror
            </label>

            <input type="checkbox" name="is_open" class="checkbox-input" {{ old('is_open', true) ? 'checked' : '' }} hidden id="is_open"/>
            <label class="checkbox-input-label" for="is_open">
                <span class="checkbox-input-text">Open for voting</span>
                @error('is_open')
                <span class="text-failure text-sm font-normal">{{ $message }}</span>
                @enderror
            </label>
        </div>

        <p class="my-2">
            Creating a proposition with a single horizontal option makes a list proposition,
            otherwise the users will be presented with a grid.<br/>
            Empty options will be filtered out.
        </p>
        <proposition-option-editor
            :errors='@json($errors->get('options.*'))'
            :source-options='@json($mappedOldOptions)'
        ></proposition-option-editor>

        <input type="submit" class="submit-button self-start" value="create"/>
    </form>
@endsection
