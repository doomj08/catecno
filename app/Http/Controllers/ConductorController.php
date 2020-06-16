<?php

namespace App\Http\Controllers;

use App\Conductor;
use App\Http\Requests\ConductorRequest;
use Illuminate\Http\Request;

class ConductorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $items=Conductor::all();
            return [
                'tabla'=>$items,
                'listas'=>[
                ]
            ];
        }
        return view('conductores.index');
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
    public function store(ConductorRequest $request)
    {
        Conductor::create($request->all());
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Conductor  $conductor
     * @return \Illuminate\Http\Response
     */
    public function show(Conductor $conductor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Conductor  $conductor
     * @return \Illuminate\Http\Response
     */
    public function edit(Conductor $conductor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Conductor  $conductor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conductor $conductor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Conductor  $conductor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conductor $conductor)
    {
        //
    }
}