<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Dashboard Cards
        $cards = array(
            'urls'      => DB::table('urls')->count(),
            'clicks'    => DB::table('stats')->count(),
            'contacts'  => DB::table('contacts')->where('done', 0)->count(),
            'reports'   => DB::table('reports')->where('done', 0)->count()
        );


        // Query last 15 created urls with click numbers
        $q_urls = DB::table('urls')
                    ->selectRaw('urls.id, COUNT(stats.id) as clicks')
                    ->leftJoin('stats', 'stats.url_id', '=', 'urls.id')
                    ->where('urls.active', 1)
                    ->groupBy('urls.id')
                    ->orderByDesc('urls.id')
                    ->limit(15)
                    ->get()
        ;

        $urls = array();
        foreach ($q_urls as $uk => $uv) {
            $urls[] = array(
                'id'        => $uv->id,
                'slug'      => Hashids::encode($uv->id),
                'clicks'    => $uv->clicks
            );
        }

        // Query open contact requests
        $q_contacts = DB::table('contacts')
                    ->where('done', '=', 0)
                    ->limit(15)
                    ->get()
        ;

        $contacts = array();
        foreach ($q_contacts as $kc => $vc) {
            $contacts[] = array(
                'id'        => $vc->id,
                'subject'   => $vc->subject,
                'date'      => $vc->created_at,
                'done'      => ($vc->done)
            );
        }

        // Query open report requests
        $q_reports = DB::table('reports')
                    ->where('done', '=', 0)
                    ->limit(15)
                    ->get()
        ;

        $reports = array();
        foreach ($q_reports as $kc => $vc) {
            $reports[] = array(
                'id'        => $vc->id,
                'date'      => $vc->created_at,
                'done'      => ($vc->done)
            );
        }

        $tables = array(
            'urls'      => $urls,
            'contacts'  => $contacts,
            'reports'   => $reports
        );

        return view('admin.dashboard')->with('cards', $cards)->with('tables', $tables);
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
        //
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
