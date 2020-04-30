@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('admin.propositions.store') }}" class="flex flex-col">
        @csrf
        <h1>Proposition info</h1>

        <label>Title <input type="text" required name="title"/></label>
        <label><input type="checkbox" name="is_open"/> Is open</label>
        <label>Order <input type="number" min="1" name="order"/></label>

        <proposition-option-editor></proposition-option-editor>

        <input type="submit"/>
    </form>
@endsection
