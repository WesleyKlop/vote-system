<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>{{ config('app.title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"/>
    <script defer src="{{ mix('js/app.js') }}"></script>
    <style>
    :root {
        @if($primaryColor)
            --primary-color: {{ $primaryColor }};
        @endif
        @if($accentColor)
            --accent-color: {{ $accentColor }};
        @endif
    }
    </style>
</head>
<body>
<div id="app" class="container mx-auto flex flex-col min-h-screen">
    @include('components.header-voter')
    @section('content')@show
    <div class="flex-1"></div>
    @include('components.footer')
</div>
</body>
</html>
