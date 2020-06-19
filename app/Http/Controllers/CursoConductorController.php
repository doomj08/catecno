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
            $items=Table::with('Curso','EmpresaTransporte','Conductor')->orderby('id','desc')->get();
            $list1=Conductor::get()->pluck('nombre_cedula','id');
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

    public function store(Request $request)
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
