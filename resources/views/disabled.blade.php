@extends('layouts/app')

@section('title', 'Link disabled')

@section('content')
<section class="mx-auto text-center w-full">
    
    <p class="text-white">This link has been disabled or deleted by administrators.</p>

    <a href="{{ route('home') }}" target="_self" rel="noopener noreferrer" class="text-white font-bold underline uppercase">home</a>
</section>
@endsection