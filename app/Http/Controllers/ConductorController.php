<?php

namespace App\Http\Controllers;

use App\Conductor as Table;
use App\Http\Requests\ConductorRequest;
use App\Institucion;
use Illuminate\Http\Request;

class ConductorController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $items=Table::paginate(10);
            $instituciones=Institucion::pluck('id','nombre');
            return [
                'tabla'=>$items,
                'listas'=>[
                    'instituciones'=>$instituciones
                ],
                'pagination'=>[
                    'total'=>$items->total(),
                    'per_page'=>$items->perPage(),
                    'current_page'=>$items->currentPage(),
                    'last_page'=>$items->lastPage(),
                    'from'=>$items->firstItem(),
                    'to'=>$items->lastItem(),
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
