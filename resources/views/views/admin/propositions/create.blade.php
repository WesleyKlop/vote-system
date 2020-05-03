@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('admin.propositions.store') }}" class="flex flex-col">
        <h1 class="title col-span-1 lg:col-span-2 px-8 sm:px-0">Create proposition</h1>
        @csrf

        <div class="w-64">
            <label class="input-label">
                Title
                <input type="text" required name="title" class="input"/>
            </label>
            <label class="input-label flex-row items-center">
                <input type="checkbox" name="is_open" class="mr-4"/> Is open
            </label>
            <label class="input-label">
                Order
                <input type="number" min="1" name="order" class="input"/>
            </label>
        </div>

        <proposition-option-editor></proposition-option-editor>

        <input type="submit"/>
    </form>
@endsection
