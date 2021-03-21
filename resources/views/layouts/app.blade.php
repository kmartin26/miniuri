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
    
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#b91d47">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="css/app.css">
</head>
<body class="flex flex-col h-screen bg-gray-800">
    <div class="flex flex-col w-full h-full container mx-auto">
        <header class="flex flex-col md:flex-row items-center content-beetwen pt-6 mx-8 mb-auto">
            <a class="logo flex text-4xl font-semibold text-white mb-3 md:mb-0" href="{{ url('/') }}">{{ env('APP_NAME') }}</a>
            @include('layouts.menus.main')
        </header>
        @yield('content')
        <footer class="flex flex-col md:flex-row-reverse items-center content-beetwen mx-8 mt-auto pb-6 text-white">
            @include('layouts.menus.footer')
            <div class="mb-2 md:mb-0 mx-auto">Made with 
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 inline text-red-600 align-top" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                </svg>
            </div>
            <div>Copyright 2020 - {{ env('APP_NAME') }}</div>
        </footer>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>