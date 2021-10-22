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

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet"> 

    <link rel="stylesheet" href="{{ asset('css/admin/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
</head>
<body class="flex flex-col h-full bg-gray-100">
    <div class="flex flex-row w-full min-h-screen h-full">
        <aside class="flex flex-col items-center content-beetwen w-2/12 bg-gray-800">
            <a class="flex text-4xl font-extrabold text-white my-5" href="{{ url('/admin') }}">{{ env('APP_NAME') }}</a>
            @include('admin.layouts.menu')
        </aside>
        <main class="mx-auto w-full pb-6">
            <header class="flex w-full h-10 bg-white shadow-md">
                <div class="flex items-center h-full w-5/6 pl-8 text-lg font-semibold uppercase text-gray-700">
                    <h2>@yield('title')</h2>
                </div>
                <div class="flex items-center h-full w-1/6 pr-8 text-xs justify-end uppercase text-gray-700">
                    <a class="hover:underline" href="{{ route('home') }}">Website</a>
                    <span class="mx-2">/</span>
                    <a class="hover:underline"  href="{{ route('logout') }}">Logout</a>
                </div>
            </header>
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/admin/jquery.min.js') }}"></script>
    <script src="{{ asset('js/admin/app.js') }}"></script>
</body>
</html>