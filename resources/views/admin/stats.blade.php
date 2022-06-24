@extends('admin.layouts.app')

@section('title', 'Stats')

@section('content')
<div id="content">
    <div id="cards" class="flex flex-row justify-evenly mt-6 text-white h-32">
        <div class="urls bg-blue-500 hover:shadow-md">
            <div class="text-lg font-medium">Total URLs</div>
            <div class="text-2xl font-bold italic">{{ number_format($cards['total_urls'], 0, ',', ' ') }}</div>
        </div>
        <div class="urls month bg-purple-500 hover:shadow-md">
            <div class="text-lg font-medium">Last 30 days</div>
            <div class="text-2xl font-bold italic">{{ number_format($cards['monthly_urls'], 0, ',', ' ') }}</div>
        </div>
        <div class="stats bg-green-500 hover:shadow-md">
            <div class="text-lg font-medium">Total Clicks</div>
            <div class="text-2xl font-bold italic">{{ number_format($cards['total_clicks'], 0, ',', ' ') }}</div>
        </div>
        <div class="stats month bg-yellow-500 hover:shadow-md">
            <div class="text-lg font-medium">Last 30 days</div>
            <div class="text-2xl font-bold italic">{{ number_format($cards['monthly_clicks'], 0, ',', ' ') }}</div>
        </div>
    </div>
    <div id="cols" class="flex flex-row justify-evenly mt-6 h-full">
        @if (isset($tables['most_visited']))
            <div class="w-1/4 bg-white p-3 rounded-lg mx-4">
                <div class="text-lg font-semibold mb-2">
                    Top 10 most visited
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
                            @foreach ($tables['most_visited'] as $url)
                            <tr>
                                <td class="p-2">{{ $url['id'] }}</td>
                                <td class="p-2">
                                    <a class="text-blue-600 hover:underline hover:font-semibold" href="{{ route('admin.stats.url', $url['id']) }}">{{ $url['slug'] }}</a>
                                </td>
                                <td class="p-2">{{ $url['clicks'] }}</td>
                            </tr> 
                            @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div class="flex flex-col w-3/4 bg-white p-3 rounded-lg mr-4">
            <div class="flex">
                <div class="w-1/2">
                    <div class="text-lg font-semibold mb-2">
                        Top months urls (12 months)
                    </div>
                    <div class="h-52">
                        <canvas id="topMonthsUrls"></canvas>
                    </div>
                </div>
                <div class="w-1/2 ml-4">
                    <div class="text-lg font-semibold mb-2">
                        Top browsers (12 months)
                    </div>
                    <div class="h-52">
                        <canvas id="topBrowsers"></canvas>
                    </div>
                </div>
            </div>
            
            <div class="flex mt-8">
                <div class="w-1/2">
                    <div class="text-lg font-semibold mb-2">
                        Top months clicks (12 months)
                    </div>
                    <div class="h-52">
                        <canvas id="topMonthsClicks"></canvas>
                    </div>
                </div>
                <div class="w-1/2 ml-4">
                    <div class="text-lg font-semibold mb-2">
                        Top OSes (12 months)
                    </div>
                    <div class="h-52">
                        <canvas id="topOses"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    const ctx = $('#topMonthsUrls');
    const topMonthsUrls = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! $charts['top_months_urls']['months'] !!},
            datasets: [{
                label: '# urls',
                data: {!! $charts['top_months_urls']['totals'] !!},
                fill: false,
                borderColor: [
                    '#2CC990'
                ],
                tension: 0.5
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });

    const ctx2 = $('#topBrowsers')
    const topBrowsers = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: {!! $charts['top_browsers']['browsers'] !!},
            datasets: [{
                data: {!! $charts['top_browsers']['totals'] !!},
                backgroundColor: [
                    '#8ecae6',
                    '#219ebc',
                    '#023047',
                    '#ffb703',
                    '#fb8500'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    const ctx3 = $('#topMonthsClicks');
    const topMonthsClicks = new Chart(ctx3, {
        type: 'line',
        data: {
            labels: {!! $charts['top_months_clicks']['months'] !!},
            datasets: [{
                label: '# clicks',
                data: {!! $charts['top_months_clicks']['totals'] !!},
                fill: false,
                borderColor: [
                    '#8870FF'
                ],
                tension: 0.5
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });

    const ctx4 = $('#topOses')
    const topOses = new Chart(ctx4, {
        type: 'pie',
        data: {
            labels: {!! $charts['top_oses']['oses'] !!},
            datasets: [{
                data: {!! $charts['top_oses']['totals'] !!},
                backgroundColor: [
                    '#8ecae6',
                    '#219ebc',
                    '#023047',
                    '#ffb703',
                    '#fb8500'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endsection