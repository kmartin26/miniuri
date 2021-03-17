<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @if (Route::currentRouteName() == 'home')
        <title>{{ env('APP_NAME')}} - @yield('title')</title>
    @else
        <title>@yield('title') - {{ env('APP_NAME')}}</title>
    @endif
   

    <link rel="stylesheet" href="css/app.css">
</head>
<body class="flex flex-col h-screen bg-gray-800">
    <div class="flex flex-col w-full h-full container mx-auto">
        <header class="flex flex-col md:flex-row items-center content-beetwen pt-6 mx-3 mb-auto">
            <a class="logo flex text-4xl font-semibold text-white mb-3 md:mb-0" href="{{ url('/') }}">{{ env('APP_NAME') }}</a>
            @include('layouts.menus.main')
        </header>
        @yield('content')
        <footer class="flex flex-col md:flex-row-reverse items-center content-beetwen mt-auto pb-6 text-white">
            @include('layouts.menus.footer')
            <div>Copyright 2020 - {{ env('APP_NAME') }}</div>
        </footer>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>