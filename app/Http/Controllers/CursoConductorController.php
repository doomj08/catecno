<?php

namespace App\Http\Controllers;

use App\Conductor;
use App\Curso;
use App\CursoConductor  as Table;
use App\CursoConductor;
use App\EmpresaTransporte;
use App\Http\Requests\ConductorRequest;
use App\Http\Requests\CursoConductorRequest;
use Illuminate\Http\Request;

class CursoConductorController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $items=Table::with('Curso','EmpresaTransporte','Conductor')->orderby('id','asc')->get();
            $list1=Conductor::pluck('nombres','id');
            $list2=EmpresaTransporte::pluck('razon_social','id');
            $list3=Curso::pluck('nombre','id');
            return [
                'tabla'=>$items,
                'listas'=>[
                    'conductores'=>$list1,
                    'empresas_transporte'=>$list2,
                    'cursos'=>$list3,
                ]
            ];
        }
        return view('certificados.index');
    }

    public function store(CursoConductorRequest $request)
    {
        Table::create($request->all()); //TODO:agregar valor predeterminado = 1 desde controlador al campo institucion_id
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
