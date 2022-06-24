@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div id="content">
    <div id="cards" class="flex flex-row justify-evenly mt-6 text-white h-32">
        <div class="urls bg-blue-500 hover:shadow-md">
            <div class="text-lg font-medium">URLs</div>
            <div class="text-2xl font-bold italic">{{ number_format($cards['urls'], 0, ',', ' ') }}</div>
            <div class="go-to"><i class="fas fa-long-arrow-alt-right"></i></div>
            <a href="{{ route('admin.urls') }}" class="absolute inset-0"></a>
        </div>
        <div class="stats bg-purple-500 hover:shadow-md">
            <div class="text-lg font-medium">Stats</div>
            <div class="text-2xl font-bold italic">{{ number_format($cards['clicks'], 0, ',', ' ') }}</div>
            <div class="go-to"><i class="fas fa-long-arrow-alt-right"></i></div>
            <a href="{{ route('admin.stats') }}" class="absolute inset-0"></a>
        </div>
        <div class="contacts bg-green-500 hover:shadow-md">
            <div class="text-lg font-medium">Contacts</div>
            <div class="text-2xl font-bold italic">{{ number_format($cards['contacts'], 0, ',', ' ') }}</div>
            <div class="go-to"><i class="fas fa-long-arrow-alt-right"></i></div>
            <a href="{{ route('admin.contacts') }}" class="absolute inset-0"></a>
        </div>
        <div class="reports bg-yellow-500 hover:shadow-md">
            <div class="text-lg font-medium">Reports</div>
            <div class="text-2xl font-bold italic">{{ number_format($cards['reports'], 0, ',', ' ') }}</div>
            <div class="go-to"><i class="fas fa-long-arrow-alt-right"></i></div>
            <a href="{{ route('admin.reports') }}" class="absolute inset-0"></a>
        </div>
    </div>
    <div id="cols" class="flex flex-row justify-evenly mt-6 h-full">
        <div class="w-1/4 bg-white p-3 rounded-lg">
            <div class="text-lg font-semibold mb-2">
                Last URLs
            </div>
            <table class="w-full table-fixed">
                <thead class="bg-gray-300">
                    <tr>
                        <th class="w-1/4 px-2">#</th>
                        <th class="w-1/2 px-2">Slug</th>
                        <th class="w-1/4 px-2">Clicks</th>
                    </tr>
                </thead>
                <tbody class="text-center bg-white">
                    @foreach ($tables['urls'] as $url)
                        <tr>
                            <td class="p-2">{{ $url['id'] }}</td>
                            <td class="p-2">
                                <a class="text-blue-600 hover:underline hover:font-semibold" target="_blank" href="{{ url($url['slug']) }}">{{ $url['slug'] }}</a>
                            </td>
                            <td class="p-2">{{ $url['clicks'] }}</td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="w-1/3 bg-white p-3 rounded-lg">
            <div class="text-lg font-semibold mb-2">
                Open contacts
            </div>
            <table class="w-full table-auto">
                <thead class="bg-gray-300">
                    <tr>
                        <th class="px-2">#</th>
                        <th class="px-2">Subject</th>
                        <th class="px-2">Date</th>
                        <th class="px-2">Status</th>
                    </tr>
                </thead>
                <tbody class="text-center bg-white">
                    @foreach ($tables['contacts'] as $contact)
                        <tr>
                            <td class="p-2">{{ $contact['id'] }}</td>
                            <td class="p-2 leading-4">
                                {{ $contact['subject'] }}
                            </td>
                            <td class="p-2">{{ \Carbon\Carbon::parse($contact['date'])->diffForHumans() }}</td>
                            <td class="p-2">
                                @if ($contact['done'])
                                    <span class="text-green-600 p-2 rounded leading-none flex items-center justify-center">
                                        <i class="fas fa-check-circle"></i>
                                    </span>
                                @else
                                    <span class="text-yellow-600 p-2 rounded leading-none flex items-center justify-center">
                                        <i class="fas fa-circle"></i>
                                    </span>
                                @endif    
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="w-1/3 bg-white p-3 rounded-lg">
            <div class="text-lg font-semibold mb-2">
                Open reports
            </div>
            <table class="w-full table-auto">
                <thead class="bg-gray-300">
                    <tr>
                        <th class="px-2">#</th>
                        <th class="px-2">Date</th>
                        <th class="px-2">Status</th>
                    </tr>
                </thead>
                <tbody class="text-center bg-white">
                    @foreach ($tables['reports'] as $report)
                        <tr>
                            <td class="p-2">{{ $report['id'] }}</td>
                            <td class="p-2">{{ \Carbon\Carbon::parse($report['date'])->diffForHumans() }}</td>
                            <td class="p-2">
                                @if ($report['done'])
                                    <span class="text-green-600 p-2 rounded leading-none flex items-center justify-center">
                                        <i class="fas fa-check-circle"></i>
                                    </span>
                                @else
                                    <span class="text-yellow-600 p-2 rounded leading-none flex items-center justify-center">
                                        <i class="fas fa-circle"></i>
                                    </span>
                                @endif    
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection