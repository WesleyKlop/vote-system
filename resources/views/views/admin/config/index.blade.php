@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.config.update') }}" method="POST" class="px-8 sm:px-0">
        @csrf
        <h1 class="title">Config management</h1>
        <p class="mt-2 text-gray-600">
            On this page you can control certain settings used throughout the application.
        </p>
        <p class="mt-2 text-gray-800">
            <strong>Be aware</strong> that there is no validation or escaping done on these values, so trying to do anything too fancy might break the application.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 pt-6">
            @foreach($settings as $setting)
                <div class="p-2 rounded shadow">
                    <label class="font-mono w-full mb-2" for="{{ $setting->name }}">
                        {{ Str::of($setting->name)->ucfirst()->replace('_', ' ') }}
                    </label>
                    <textarea
                        id="{{ $setting->name }}"
                        class="input h-auto w-full resize-y"
                        rows="3"
                        name="{{ $setting->name }}"
                        placeholder="{{ $setting->default }}"
                    >{!! $setting->value !!}</textarea>
                    @error($setting->name)
                    <span class="text-failure text-sm font-normal w-full">{{ $message }}</span>
                    @enderror
                </div>
            @endforeach
        </div>
        <input type="submit" value="Save" class="submit-button"/>
    </form>
@endsection
