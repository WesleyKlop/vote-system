@extends('layouts.auth')

@section('content')
    <form action="{{ route('admin.login.update') }}" method="POST" class="bg-white shadow sm:rounded-lg p-8">
        <h2 class="text-3xl w-64">Admin Area</h2>
        @csrf

        <label class="flex flex-col text-sm my-4 text-gray-700">
            Username
            <input
                type="text"
                name="name"
                autocomplete="username"
                class="h-8 rounded border-2 border-gray-300 px-1 text-base"
                placeholder="Admin"
            />
        </label>
        <label class="flex flex-col text-sm my-4 text-gray-700">
            Password
            <input
                type="password"
                name="password"
                autocomplete="current-password"
                class="h-8 rounded border-2 border-gray-300 px-1 text-base"
                placeholder="hunter2"
            />
        </label>

        <input
            type="submit"
            value="Sign in"
            class="uppercase font-bold text-md py-2 px-5 rounded my-4 bg-gray-900 text-white"
        />
    </form>
@endsection
