@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('admin.propositions.store') }}" class="flex flex-col">
        @csrf
        <h1>Proposition info</h1>

        <label>Title <input type="text" required name="title" value="{{ old('title', $proposition->title) }}"/></label>
        <label><input type="checkbox" name="is_open" {{ old('is_open', $proposition->is_open) ? 'checked' : '' }}/> Is open</label>
        <label>Order <input type="number" min="1" name="order" value="{{ old('order', $proposition->order) }}"/></label>

        <proposition-option-editor
            :source-options='@json($proposition->options)'
        ></proposition-option-editor>

        <input type="submit"/>
    </form>
@endsection
