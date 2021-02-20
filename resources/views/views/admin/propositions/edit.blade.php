@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('admin.propositions.update', $proposition) }}" class="flex flex-col items-stretch px-8 sm:px-0 w-full lg:w-3/4">
        <h1 class="title">@lang('Edit proposition')</h1>
        @csrf
        @method('PUT')

        <div class="">
            <label class="input-label">
                @lang('Title')
                <input
                    type="text"
                    required
                    name="title"
                    class="input"
                    placeholder="@lang('Is it okay to put pineapple on pizza?')"
                    value="{{ old('title', $proposition->title) }}"
                />
            </label>

            <label class="input-label">
                @lang('Order')
                <input
                    type="number"
                    min="1"
                    name="order"
                    class="input"
                    placeholder="1"
                    value="{{ old('order', $proposition->order) }}"
                />
            </label>

            <input
                type="checkbox"
                name="is_open"
                class="checkbox-input"
                {{ old('is_open', $proposition->is_open) ? 'checked' : '' }}
                hidden
                id="is_open"
            />
            <label class="checkbox-input-label" for="is_open">
                <span class="checkbox-input-text">@lang('Open for voting')</span>
                @error('is_open')
                <span class="text-failure text-sm font-normal">{{ $message }}</span>
                @enderror
            </label>
        </div>

        <proposition-option-editor
            :errors='@json($errors->get('options.*'))'
            :source-options='@json($mappedOldOptions)'
            initial-type="{{ $proposition->type }}"
        ></proposition-option-editor>

        <input type="submit" class="submit-button self-start" value="@lang('Update')"/>
    </form>
@endsection
