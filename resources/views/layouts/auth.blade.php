<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>{{ config('app.title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"/>
    <script defer src="{{ mix('js/app.js') }}"></script>
</head>
<body class="bg-gray-100">
<div id="app" class="container mx-auto h-screen flex items-center justify-center">
    @section('content')@show
</div>
</body>
</html>
