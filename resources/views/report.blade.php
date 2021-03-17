@extends('layouts/app')

@section('title', 'Report')

@section('content')
<section class="text-center mx-5 lg:mx-auto my-10 lg:w-1/2 text-white">

    @if ($errors->any())
        <div class="alert alert-danger w-2/3 mx-auto mb-5" role="alert">
            <ul>
                <li>{{ $errors->first() }}</li>
            </ul>
        </div>
    @elseif(Session::has('success'))
        <div class="alert alert-success w-2/3 mx-auto mb-5" role="alert">
            {{Session::get('success')}}
        </div>
    @endif

    <form action="{{ route('report.store') }}" method="post" class="w-2/3 mx-auto text-left text-white">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="name">
                Name
            </label>
            <input type="text" name="name" id="name" class="input">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input type="text" name="email" id="email" class="input">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="message">
                Message
            </label>
            <textarea name="message" id="message" rows="8" class="input" placeholder="Don't forget your reported urls inside your message"></textarea>
        </div>
        <div class="mb-4">
            <button type="submit" class="flex items-center justify-center text-xl w-full bg-blue-600 py-2 rounded hover:bg-blue-700 active:bg-blue-800 cursor-pointer">
                Send
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 transform rotate-45 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
            </button>
        </div>
    </form>
</section>
@endsection