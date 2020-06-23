<?php

namespace App\Http\Controllers;

use App\Conductor;
use App\Curso;
use App\CursoConductor  as Table;
use App\EmpresaTransporte;
use App\Http\Requests\ConductorRequest;
use App\Http\Requests\CursoConductorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CursoConductorController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){

            $items=Table::with('Curso','EmpresaTransporte','Conductor')->Buscar($request->filter)->orderby('id','desc')->paginate($request->per_page);
            $list1=Conductor::orderby('id','desc')->get()->pluck('id','nombre_cedula');
            $list2=EmpresaTransporte::orderby('id','desc')->pluck('id','razon_social');
            $list3=Curso::orderby('id','desc')->pluck('id','nombre');
            return [
                'tabla'=>$items,
                'listas'=>[
                    'conductores'=>$list1,
                    'empresas_transporte'=>$list2,
                    'cursos'=>$list3,
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
        return view('certificados.index');
    }

    public function store(CursoConductorRequest $request)
    {
        Table::create($request->all());
        return;
    }

    public function update(CursoConductorRequest $request)
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
