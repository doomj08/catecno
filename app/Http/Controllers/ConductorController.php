<?php

namespace App\Http\Controllers;

use App\Conductor;
use App\Http\Requests\ConductorRequest;
use Illuminate\Http\Request;

class ConductorController extends Controller
{
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

    public function store(ConductorRequest $request)
    {
        Conductor::create($request->all());
        return;
    }

    public function update(ConductorRequest $request, Conductor $conductor)
    {
        Conductor::findOrFail($request->id)->update($request->all());
        return;
    }
    public function destroy($id)
    {
        //Conductor::findOrFail($id)->delete();
        return;
    }
}
