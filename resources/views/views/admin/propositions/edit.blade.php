@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('admin.propositions.update', $proposition) }}" class="flex flex-col items-stretch px-8 sm:px-0 w-full lg:w-3/4">
        <h1 class="title">Edit proposition</h1>
        @csrf
        @method('PUT')

        <div class="">
            <label class="input-label">
                Title
                <input
                    type="text"
                    required
                    name="title"
                    class="input"
                    placeholder="Is it okay to put pineapple on pizza?"
                    value="{{ old('title', $proposition->title) }}"
                />
            </label>

            <label class="input-label">
                Order
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
                <span class="checkbox-input-text">Open for voting</span>
            </label>
        </div>

        <p class="my-2">
            Propositions that are updated that only have a single horizontal options are updated to list propositions.
            Propositions with multiple horizontal options are updated to a grid.<br/>
            Empty options will be filtered out.
        </p>
        <proposition-option-editor
            :errors='@json($errors->get('options.*'))'
            :source-options='@json($mappedOldOptions)'
        ></proposition-option-editor>

        <input type="submit" class="submit-button self-start" value="update"/>
    </form>
@endsection
