@extends('layouts.admin')

@section('content')
    <form
        method="POST"
        action="{{ route('admin.propositions.store') }}"
        class="flex flex-col items-stretch px-8 sm:px-0 w-full lg:w-3/4 xl:w-1/2"
    >
        <h1 class="title">@lang('Create proposition')</h1>
        @csrf

        <div>
            <x-form.textfield name='title' required placeholder='Is it okay to put pineapple on pizza?' label='Title' />

            <x-form.textfield name='order' required placeholder='1' type='number' label='Order' min='1' />

            <x-form.checkbox
                name='has_abstain'
                label='Has abstain option'
                :hint='__("Abstain option explanation")'
            />

            <x-form.checkbox
                name='has_blank'
                label='Has blank option'
                :hint='__("Blank option explanation")'
            />
        </div>

        <proposition-option-editor
            :errors='@json($errors->get('options.*'))'
            :source-options='@json($mappedOldOptions)'
            initial-type="list"
        ></proposition-option-editor>

        <x-form.button type='submit'>@lang('Create')</x-form.button>
    </form>
@endsection
