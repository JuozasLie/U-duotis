<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
{{--            @vite(['resources/scss/app.scss', 'resources/js/app.js'])--}}
        </style>
    </head>
    <body class="text-bg-primary d-flex align-items-center justify-content-center min-vh-100">
        <section class="w-75 h-75 bg-light rounded p-2" style="min-height: 75vh;">
            <div class="row g-0 pb-3 d-flex justify-content-between" id="header">
                <div class="col-3">
                    <a href="{{ route('trucks.index') }}" type="button" class="btn btn-success w-100">Trucks Crud</a>
                </div>
                <div class="col-3">
                    <a href="{{ route('home') }}" type="button" class="btn btn-info w-100">Home</a>
                </div>
                <div class="col-3">
                    <a href="{{ route('subunit.index') }}" type="button" class="btn btn-secondary w-100">Subunit Crud</a>
                </div>
            </div>
            @yield('content')
        </section>
        @vite(['resources/js/app.js'])
    </body>
</html>
