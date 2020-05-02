@extends('layouts.auth')

@section('content')
    <form action="{{ route('admin.login.update') }}" method="POST" class="bg-white shadow sm:rounded-lg p-8">
        <h2 class="title w-64">Admin Area</h2>
        @csrf

        <label class="input-label">
            Username
            <input
                type="text"
                name="name"
                autocomplete="username"
                class="input"
                placeholder="Admin"
            />
        </label>
        <label class="input-label">
            Password
            <input
                type="password"
                name="password"
                autocomplete="current-password"
                class="input"
                placeholder="hunter2"
            />
        </label>

        <input
            type="submit"
            value="Sign in"
            class="submit-button"
        />
    </form>
@endsection
