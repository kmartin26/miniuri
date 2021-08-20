@extends('admin.layouts.app')

@section('title', 'URLs')

@section('content')
<div id="content" class="flex flex-row justify-evenly">
    <div id="list" class="flex flex-col m-6 bg-white rounded-t">
        <div class="heading p-4 font-bold">
            URLs ({{ $urls->total()}})
        </div>
        <table class="w-full table-fixed mb-2">
            <thead class="bg-gray-300">
                <tr>
                    <th class="w-24 px-2">#</th>
                    <th class="w-24 px-2">Slug</th>
                    <th class="px-2">URL</th>
                    <th class="w-24 px-2">Clicks</th>
                    <th class="w-32 px-2">Date</th>
                    <th class="w-32 px-2">Actions</th>
                </tr>
            </thead>
            <tbody class="text-center bg-white">
                @foreach ($urls as $url)
                    <tr>
                        <td class="p-2">{{ $url->id }}</td>
                        <td class="p-2">
                            {{ Hashids::encode($url->id)}}
                        </td>
                        <td class="p-2 truncate">
                            <a href="{{ $url->url }}" target="_blank"><img src="https://www.google.com/s2/favicons?domain={{ $url->url }}" alt="" class="inline mr-2">{{ $url->url }}</a>
                        </td>
                        <td class="p-2">{{ $url->clicks }}</td>
                        <td class="p-2">{{ \Carbon\Carbon::parse($url->created_at)->format('d-m-Y') }}</td>
                        <td class="p-2">
                            @if ($url->active)
                                <button class="disable p-1 rounded border-2 border-red-700 bg-red-600 text-white text-sm w-full" data-id="{{ $url->id }}">Disable</button>
                            @else
                                <button class="enable p-1 rounded border-2 border-blue-700 bg-blue-600 text-white text-sm w-full" data-id="{{ $url->id }}">Enable</button>
                            @endif
                        </td>
                    </tr> 
                @endforeach
            </tbody>
        </table>
        <div class="p-4 mt-2 border-t">{{ $urls->links() }}</div>
    </div>
</div>
@endsection