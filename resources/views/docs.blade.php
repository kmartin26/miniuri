@extends('layouts/app')

@section('title', 'API Docs')

@section('content')
<section class="text-left mx-5 lg:mx-auto my-10 lg:w-1/2 text-white">
    <h1 class="text-4xl">API Documentation</h1>
    <hr class="my-6">
    <p>
        <i>miniuri.me</i> provide a simple and fast API to give you the possibility to programatically
        generate short url within your applications.
    </p>
    <h2 class="text-3xl mt-4 mb-2">API version 1</h2>
    <p>Currently our API v1 has the most basic function (more coming). To know :</p>
        <ul class="list-disc list-inside mb-3 ml-3">
            <li>Creating a short url</li>
        </ul>
    <p>Later, as our system evolves, we will offer more advanced features.
        If you have ideas for improvements <a href="{{ url('contact') }}">contact-us</a>.
    </p>
    <h3 class="text-2xl mt-3">Actions</h3>
    <pre class="w-min px-2 text-lg bg-gray-700 border-2 rounded border-gray-400 my-3"><b>POST</b> /api/v1/create</pre>
    <p>Parameters :</p>
    <ul class="list-disc list-inside mb-3 ml-3">
        <li>url - the long url you want to shorten (e.g. <u>https://www.amazon.com/</u>)</li>
    </ul>
    <p>Specificities :</p>
    <ul class="list-disc list-inside mb-3 ml-3">
        <li>Long URLs must be encoded to prevent reserved characters like ?, &, # or spaces from interfering in your request.</li>
    </ul>
    <p>Reply :</p>
    <ul class="list-disc list-inside mb-3 ml-3">
        <li>Format : json</li>
        <li>Values : 
            <ul class="list-circle list-inside mb-3 ml-3">
                <li>code - 200 when it's okay, than 400 if something is wrong with the request</li>
                <li>message - come with the code to give more informations</li>
                <li>result - the shorten url</li>
            </ul>
        </li>
    </ul>
    <p>Limitations :</p>
    <ul class="list-disc list-inside mb-3 ml-3">
        <li class="whitespace-pre-line">
            There are currently no restrictions limiting this API. 
            So you are free to use it fully, but keep in mind that this service is offered for free and cannot handle millions of requests per second.
        </li>
    </ul>
    
</section>
@endsection