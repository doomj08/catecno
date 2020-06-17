<?php

namespace App\Http\Controllers;

use App\Conductor as Table;
use App\Http\Requests\ConductorRequest;
use Illuminate\Http\Request;

class ConductorController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $items=Table::get();
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
        Table::create($request->all());
        return;
    }

    public function update(ConductorRequest $request)
    {
        Table::findOrFail($request->id)->update($request->all());
        return;
    }

    public function destroy($id)
    {
        Table::findOrFail($id)->delete();
        return;
    }

}
