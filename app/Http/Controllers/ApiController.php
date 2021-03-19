<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Vinkla\Hashids\Facades\Hashids;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // Validate request parameters
        $validator = Validator::make($request->all(), [
            'url' => ['required', 'url']
        ]);

        if ( $validator->fails() ) {
            $errors = $validator->errors();

            return response()->json(
                [
                    'code' => 400,
                    'message' => $errors->first('url')
                ], 
                400
            );
        }
        $validated = $validator->validated();

        if ( parse_url($validated['url'], PHP_URL_HOST) == parse_url(env('APP_URL'), PHP_URL_HOST) ) {
            return response()->json(
                [
                    'code' => 200,
                    'error' => 'ALREADY_SHORTEN',
                    'message' => 'This url is already shorten'
                ],
                200
            );
        }

        $exist = DB::table('urls')->where('url', 'LIKE', $validated['url'])->get();

        if ( !$exist->isEmpty() ) {
            $url = $exist->first();
        } else {
            $url = new Url();
            $url->url = $validated['url'];
            $url->method = (!empty($request->method) && strtolower($request->method) == 'web') ? 'web' : 'api';
            $url->creator_ip = $request->ip();
            $url->save();
        }

        
        $slug = Hashids::encode($url->id);

        return response()->json(
            [
                'code' => 200,
                'message' => 'Successfully created short uri',
                'result' => url($slug)
            ],
            200
        );
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
