@extends('admin.layouts.app')

@section('title', 'Stats details')

@section('content')
<div id="content">
    <div class="m-4 text-2xl font-bold">
        <a class="text-blue-600 hover:underline" target="_blank" href="{{ url($url['slug']) }}">{{ $url['slug'] }}</a>
         - {{ $url['url'] }}
    </div>
    <div class="m-4 p-4 flex bg-gray-200 border-2 rounded-md shadow-sm">
        <div class="flex-auto">Total access : {{ $url['clicks'] }}</div>
        <div class="flex-auto">Created at : {{ \Carbon\Carbon::parse( $url['created_at'] )->toDateTimeString() }}</div>
        <div class="flex-auto">Last access : {{ ( !empty($url['last_access']) ) ? $url['last_access'] : 'never' }}</div>
        <div class="flex-auto">Creator IP : {{ $url['creator_ip'] }}</div>
    </div>
    <div class="m-4 w-100 bg-white p-3 rounded-lg">
        <div class="text-lg font-semibold mb-2">
            Access per month (12 months)
        </div>
        <div class="h-52">
            <canvas id="accessPerMonth"></canvas>
        </div>
    </div>
    <div class='flex'>
        <div class="ml-4 w-1/3 bg-white p-3 rounded-lg">
            <div class="text-lg font-semibold mb-2">
                Top 10 IPs
            </div>
            <div class="">
                <table class="w-full table-fixed">
                    <thead class="bg-gray-300">
                        <tr>
                            <th class="w-1/2 px-2">IP</th>
                            <th class="w-1/4 px-2">Visits</th>
                        </tr>
                    </thead>
                    <tbody class="text-center bg-white">
                        @foreach ($tables['top_ips'] as $ip)
                            <tr>
                                <td class="p-2">{{ $ip['ip'] }}</td>
                                <td class="p-2">{{ $ip['total'] }}</td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="ml-4 w-1/3 bg-white p-3 rounded-lg">
            <div class="text-lg font-semibold mb-2">
                Top 10 countries
            </div>
            <div class="">
                <table class="w-full table-fixed">
                    <thead class="bg-gray-300">
                        <tr>
                            <th class="w-1/2 px-2">Country</th>
                            <th class="w-1/4 px-2">Visits</th>
                        </tr>
                    </thead>
                    <tbody class="text-center bg-white">
                        @foreach ($tables['top_countries'] as $country => $visits)
                            <tr>
                                <td class="p-2">{{ $country }}</td>
                                <td class="p-2">{{ $visits }}</td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mx-4 w-1/3 bg-white p-3 rounded-lg">
            <div class="text-lg font-semibold mb-2">
                Top 10 referers
            </div>
            <div class="">
                <table class="w-full table-fixed">
                    <thead class="bg-gray-300">
                        <tr>
                            <th class="w-1/2 px-2">IP</th>
                            <th class="w-1/4 px-2">Visits</th>
                        </tr>
                    </thead>
                    <tbody class="text-center bg-white">
                        @foreach ($tables['top_referers'] as $referer)
                            <tr>
                                <td class="p-2">{{ $referer['referer'] }}</td>
                                <td class="p-2">{{ $referer['total'] }}</td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    
</div>
@endsection

@section('script')
<script>
    const ctx = $('#accessPerMonth');
    const accessPerMonth = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! $charts['access_per_month']['months'] !!},
            datasets: [{
                label: '# access',
                data: {!! $charts['access_per_month']['totals'] !!},
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
</script>
@endsection