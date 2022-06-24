@extends('layouts.app', ['menu' => $menu])

@section('title', 'Simple url shortener with API')

@section('content')
<section class="mx-auto text-center w-full">
    <h1 class="text-white text-4xl font-bold">Past and shorten</h1>
    <form action="{{ route('home') }}" class="form flex items-center justify-center mx-8 xl:mx-0 pt-2">
        <input type="text" name="url" class="h-10 w-full sm:w-1/2 xl:w-1/3 outline-none rounded-none rounded-l-lg p-2">
        <button type="submit" class="btn btn-submit flex justify-center items-center font-bold py-2 px-4 outline-none rounded-none rounded-r-lg">
            <span class="mr-1">Go</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="ico-flash" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="ico-copy" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
            </svg>
        </button>
    </form>
    <div class="alert-box w-1/2 h-12 mx-auto my-3" role="alert">
        <div class="alert hidden"></div>
    </div>
    <div class="restart flex items-center justify-center h-10">
        <button class="btn btn-restart flex justify-center items-center font-bold py-2 px-4 outline-none rounded-lg hidden">
            <span class="mr-1">Restart</span> 
            <svg xmlns="http://www.w3.org/2000/svg" class="ico-restart" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
        </button>
    </div>
</section>
@endsection