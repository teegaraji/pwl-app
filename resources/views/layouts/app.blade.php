<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- js --}}
    <script src="{{ asset('js/darkmode.js') }}"></script>
</head>

<body class="text-secondary bg-primary flex justify-center">

    @include('layouts.partials.header')

    <div class="container mx-60 mt-65 sm:mt-35 lg:mt-25">
        @yield('content')
    </div>


    @stack('scripts')
</body>

</html>
