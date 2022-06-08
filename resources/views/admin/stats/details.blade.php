@extends('admin.layouts.app')

@section('title', 'Stats details')

@section('content')
<div id="content">
    <div class="m-4 text-2xl font-bold">{{ $url['slug'] }} - {{ $url['url'] }}</div>
    <div class="m-4 p-4 bg-gray-300 border-2 rounded-md shadow-sm">
        <div class="">Created at : {{ \Carbon\Carbon::parse( $url['created_at'] )->toDateTimeString() }}</div>
    </div>
    
</div>
@endsection
