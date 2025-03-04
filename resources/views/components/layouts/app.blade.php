<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet"/>
    @vite(['resources/sass/app.scss', 'resources/sass/fa/fontawesome.scss', 'resources/sass/fa/solid.scss', 'resources/js/app.js'])
</head>
<body class="container-fluid">
{{ $slot }}
</body>
</html>