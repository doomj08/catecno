<?php

namespace App\Http\Controllers;

use App\Conductor;
use App\Curso;
use App\CursoConductor;
use App\EmpresaTransporte;
use Illuminate\Http\Request;

class CursoConductorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $items=CursoConductor::with('Curso','EmpresaTransporte','Conductor')->orderby('id','asc')->get();
            $list1=Conductor::pluck('Nombres','id');
            $list2=EmpresaTransporte::pluck('Razon_social','id');
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
     * @param  \App\CursoConductor  $cursoConductor
     * @return \Illuminate\Http\Response
     */
    public function show(CursoConductor $cursoConductor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CursoConductor  $cursoConductor
     * @return \Illuminate\Http\Response
     */
    public function edit(CursoConductor $cursoConductor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CursoConductor  $cursoConductor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CursoConductor $cursoConductor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CursoConductor  $cursoConductor
     * @return \Illuminate\Http\Response
     */
    public function destroy(CursoConductor $cursoConductor)
    {
        //
    }
}
