@extends('layouts.admin')

@section('content')
    <form
        method="POST"
        action="{{ route('admin.propositions.update', $proposition) }}"
        class="flex flex-col items-stretch px-8 sm:px-0 w-full lg:w-3/4 xl:w-1/2"
    >
        <h1 class="title">@lang('Edit proposition')</h1>
        @csrf
        @method('PUT')

        <div class="">
            <x-form.textfield
                name='title'
                placeholder='Is it okay to put pineapple on pizza?'
                label='Title'
                :value='$proposition->title'
                required />

            <x-form.textfield
                name='order'
                placeholder='1'
                type='number'
                label='Order'
                min='1'
                :value='$proposition->order'
                required
            />

            <x-form.checkbox
                name='has_abstain'
                :checked='$proposition->hasAbstain()'
                label='Has abstain option'
                :hint='__("Abstain option explanation")'
            />

            <x-form.checkbox
                name='has_blank'
                :checked='$proposition->hasBlank()'
                label='Has blank option'
                :hint='__("Blank option explanation")'
            />
        </div>

        <proposition-option-editor
            :errors='@json($errors->get('options.*'))'
            :source-options='@json($mappedOldOptions)'
            initial-type="{{ $proposition->type }}"
        ></proposition-option-editor>

        <x-form.button type='submit'>@lang('Update')</x-form.button>
    </form>
@endsection
