@extends('layouts.auth')

@section('content')
    <form action="{{ route('admin.login.update') }}" method="POST" class="bg-white shadow sm:rounded-lg p-8">
        <h2 class="title w-64 flex items-center">
            <a href="{{ route('voter.index') }}">
                <svg viewBox="0 0 24 24" class="h-8 w-8">
                    <path class="secondary" d="M9.41 11H17a1 1 0 0 1 0 2H9.41l2.3 2.3a1 1 0 1 1-1.42 1.4l-4-4a1 1 0 0 1 0-1.4l4-4a1 1 0 0 1 1.42 1.4L9.4 11z"/>
                </svg>
            </a>
            @lang('Admin Area')
        </h2>
        @csrf

        <label class="input-label">
            @lang('Username')
            <input
                type="text"
                name="name"
                autocomplete="username"
                class="input"
                placeholder="@lang('Admin')"
            />
            @error('name')
            <span class="text-failure text-sm font-normal">{{ $message }}</span>
            @enderror
        </label>
        <label class="input-label">
            @lang('Password')
            <input
                type="password"
                name="password"
                autocomplete="current-password"
                class="input"
                placeholder="hunter2"
            />
            @error('password')
            <span class="text-failure text-sm font-normal">{{ $message }}</span>
            @enderror
        </label>

        <input
            type="submit"
            value="@lang('Sign in')"
            class="submit-button"
        />
    </form>
@endsection
