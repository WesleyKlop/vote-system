<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>{{ config('app.title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"/>
    <script defer src="{{ mix('js/app.js') }}"></script>
</head>
<body class="background--login">
<div id="app" class="container mx-auto min-h-screen flex flex-col items-center justify-center">
    @section('content')@show
    @include('components.footer')
</div>
</body>
</html>
