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
        <a href="{{ route('admin.index') }}" class="font-bold text-lg uppercase">Vote System</a>
        <nav>
            <a href="{{ route('admin.voters.index') }}" class="mx-2 uppercase">Voters</a>
            <a href="{{ route('admin.propositions.index') }}" class="mx-2 uppercase">Propositions</a>
            <a href="{{ route('admin.login.logout') }}" class="mx-2 uppercase">Logout</a>
        </nav>
    </header>
    @section('content')@show
</div>
</body>
</html>
