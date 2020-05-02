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
    <header class="header">
        <a href="{{ route('admin.index') }}" class="header-title">Vote System</a>
        <nav class="header-nav">
            <a href="{{ route('admin.voters.index') }}">Voters</a>
            <a href="{{ route('admin.index') }}">Propositions</a>
            <a href="{{ route('admin.login.logout') }}">Logout</a>
        </nav>
    </header>
    @section('content')@show
</div>
</body>
</html>
