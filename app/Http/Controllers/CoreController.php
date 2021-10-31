<?php

namespace App\Http\Controllers;

use App\Models\Stat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;

class CoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = array(
            'home' => array(
                'name' => 'Home',
                'route' => 'home'
            ),
            'docs' => array(
                'name' => 'API',
                'route' => 'docs'
            ),
            'contact' => array(
                'name' => 'Contact',
                'route' => 'contact'
            ),
        );
        return view('home', ['menu' => $menu]);
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
    public function show($slug, Request $request)
    {
        $decoded = Hashids::decode($slug);

        if ( !empty($decoded) ) {
            $id = reset($decoded);
            $exist = DB::table('urls')->where('id', $id)->get();

            if ( !$exist->isEmpty() ) {
                $url = $exist->first();
                
                if ($url->active === 0) {
                    return view('disabled');
                }

                $stat = new Stat();
                $stat->url_id = $url->id;
                $stat->ip = $request->ip();
                $stat->user_agent = $request->header('user-agent');
                $stat->save();

                return redirect($url->url);
            }
        }
        
        return 'this url doesn\'t exist';
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
