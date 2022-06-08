<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\Url;
use Jenssegers\Agent\Facades\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Controllers\Controller;

class StatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Stats Cards
        $month_ago = new DateTime();
        $month_ago->setTime(0, 0);
        $month_ago->modify('-1 month');
        $date = $month_ago->format('Y-m-d H:i:s');

        $cards = array(
            'total_urls'      => DB::table('urls')->count(),
            'monthly_urls'    => DB::table('urls')->where('created_at', '>=', $date)->count(),
            'total_clicks'  => DB::table('stats')->count(),
            'monthly_clicks'   => DB::table('stats')->where('created_at', '>=', $date)->count()
        );

        // Stats Tables
        $tables = array(
            'most_visited' => array()
        );

        $query = DB::table('urls')
                    ->selectRaw('urls.id, COUNT(stats.id) as clicks')
                    ->leftJoin('stats', 'stats.url_id', '=', 'urls.id')
                    ->where('urls.active', 1)
                    ->groupBy('urls.id')
                    ->orderByDesc('clicks')
                    ->limit(10)
                    ->get()
        ;

        foreach ($query as $uk => $uv) {
            $tables['most_visited'][] = array(
                'id'        => $uv->id,
                'slug'      => Hashids::encode($uv->id),
                'clicks'    => $uv->clicks
            );
        }

        // Stats Charts
        $charts = array(
            'top_months_urls' => array(),
            'top_browsers' => array(),
            'top_months_clicks' => array(),
            'top_oses' => array()
        );

        $date = new DateTime();
        $first_day = clone $date;
        $first_day->modify("-12 months");
        $first_dayDate = $first_day->format('Y-m-01');
        $last_day = clone $date;
        $last_day->modify("-1 month");
        $last_dayDate = $last_day->format('Y-m-t');

        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($first_day, $interval, $last_day);

        // Get created urls count per month last 12 months
        $months = array();
        $totals = array();

        foreach ($period as $dt) {
            $months[$dt->format('ym')] =  $dt->format('M y');
            $totals[$dt->format('ym')] =  0;
        }
        $months[$last_day->format('ym')] = $last_day->format('M y');
        $totals[$last_day->format('ym')] = 0;
        
        $query = DB::table('urls')
                    ->selectRaw("count(*) as total, date_format(created_at, '%y%m') as month_year")
                    ->whereBetween('created_at', [$first_dayDate, $last_dayDate])
                    ->groupBy('month_year')
                    ->get()
                    ->toArray()
        ;

        foreach ($query as $uv) {
            $totals[$uv->month_year] = $uv->total;
        }

        $charts['top_months_urls'] = array(
            'months' => json_encode(array_values($months)),
            'totals' => json_encode(array_values($totals))
        );

        // Get top browsers list
        $query2 = DB::table('stats')
                    ->selectRaw("user_agent")
                    ->whereBetween('created_at', [$first_dayDate, $last_dayDate])
                    ->get()
                    ->toArray()
        ;
        
        $browsers = array();
        foreach ($query2 as $uk => $uv) {
            Agent::setUserAgent($uv->user_agent);
            $browser = Agent::browser();
            if (isset($browsers[$browser])) {
                $browsers[$browser]++;
            } else {
                $browsers[$browser] = 1;
            }
        }

        arsort($browsers);

        $charts['top_browsers'] = array(
            'browsers' => json_encode(array_keys($browsers)),
            'totals' => json_encode(array_values($browsers))
        );

        // Get clicks count per month last 12 months
        $months = array();
        $totals = array();

        foreach ($period as $dt) {
            $months[$dt->format('ym')] =  $dt->format('M y');
            $totals[$dt->format('ym')] =  0;
        }
        $months[$last_day->format('ym')] = $last_day->format('M y');
        $totals[$last_day->format('ym')] = 0;
        
        $query = DB::table('stats')
                    ->selectRaw("count(*) as total, date_format(created_at, '%y%m') as month_year")
                    ->whereBetween('created_at', [$first_dayDate, $last_dayDate])
                    ->groupBy('month_year')
                    ->get()
                    ->toArray()
        ;

        foreach ($query as $uv) {
            $totals[$uv->month_year] = $uv->total;
        }

        $charts['top_months_clicks'] = array(
            'months' => json_encode(array_values($months)),
            'totals' => json_encode(array_values($totals))
        );

        // Get top OSes list
        
        $oses = array();
        foreach ($query2 as $uk => $uv) {
            Agent::setUserAgent($uv->user_agent);
            $os = Agent::platform();
            if (isset($oses[$os])) {
                $oses[$os]++;
            } else {
                $oses[$os] = 1;
            }
        }

        arsort($oses);

        $charts['top_oses'] = array(
            'oses' => json_encode(array_keys($oses)),
            'totals' => json_encode(array_values($oses))
        );


        return view('admin.stats')->with('cards', $cards)->with('tables', $tables)->with('charts', $charts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get url infos
        $url = Url::find($id)->toArray();
        $url['slug'] = Hashids::encode($url['id']);

        // dd($url);

        // Get number of clicks
        return view('admin.stats.details')->with('url', $url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
