<?php

namespace App\Http\Controllers\Admin;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urls = DB::table('urls')
                    ->selectRaw('urls.*, COUNT(stats.id) as clicks')
                    ->leftJoin('stats', 'stats.url_id', '=', 'urls.id')
                    ->groupBy('urls.id', 'urls.url', 'urls.method', 'urls.creator_ip', 'urls.created_at', 'urls.updated_at', 'urls.active')
                    ->orderByDesc('urls.id')
                    ->paginate(20)
        ;
        
        return view('admin.urls')->with('urls', $urls);
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
        $state = false;

        if ( !empty($id) ) {
            $url = Url::find($id);
            if ($request->action === 'disable') {
                $url->active = false;
            } else if ($request->action === 'enable') {
                $url->active = true;
            }
            $state = $url->save();
        }

        if ($state) {
            return response()->json(['status' => 1]);
        }
        return response()->json(['status' => 0]);
        
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
