<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>{{ config('app.title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"/>
    <script defer src="{{ mix('js/app.js') }}"></script>
</head>
<body>
<div id="app" class="container mx-auto">
    <header class="flex justify-between py-6 mb-6 border-b items-center">
        @auth('voter')
            <div class="flex bg-gray-100 rounded px-2 py-px font-mono">
                Jouw token: {{ Auth::user()->token }}
            </div>
        @else
            <a href="{{ route('voter.index') }}" class="font-bold text-lg uppercase">Vote System</a>
        @endauth
        <nav>
            @auth('voter')
                <a href="{{ route('admin.login.logout') }}" class="mx-2 uppercase">Exit</a>
            @endauth
        </nav>
    </header>
    @section('content')@show
</div>
</body>
</html>
