<?php

namespace App\Http\Controllers;

use App\Conductor;
use App\Curso;
use App\CursoConductor;
use App\EmpresaTransporte;
use Illuminate\Http\Request;
use App\Http\Requests\CursoConductorRequest;
use Illuminate\Support\Facades\Auth;

class CursoConductorController extends Controller
{
    public function index(){
        return view('registrar/certificados/index');
    }

    public function paginate($index){
        if(Auth::user()->id==1)
            $certificados=CursoConductor::withTrashed()->with('Conductor','Curso')->orderBy('id','desc')->paginate($index);
        else
            $certificados=CursoConductor::with('Conductor','Curso')->orderBy('id','desc')->paginate($index);
        return response()->json($certificados);
    }

    public function show($id){
        $certificados=CursoConductor::find($id);
    return response()->json($certificados);
}

    public function index2(Request $request)
    {
        $conductores=Conductor::Lista()->get();
        $cursos=Curso::Lista()->get();
        $empresas=EmpresaTransporte::Lista()->get();
        $top=CursoConductor::with('Curso')->latest()->take(10)->get();
        return view('registrar/index',['conductores'=>$conductores,'cursos'=>$cursos,'empresas'=>$empresas,'top'=>$top]);
    }

    public function getListas(){
        $conductores=Conductor::Lista()->get();
        $cursos=Curso::Lista()->get();
        $empresas=EmpresaTransporte::Lista()->get();
        $listas=["cursos"=>$cursos,"conductores"=>$conductores,"empresas"=>$empresas];
        return response($listas);
    }

    public function update($id,CursoConductorRequest $request){
        $certificado=CursoConductor::with('Conductor','Curso')->find($id);
        $certificado->curso_id=$request->curso;
        $certificado->conductor_id=$request->conductor;
        $certificado->empresa_transporte_id=$request->empresa;
        $certificado->carnet=$request->carnet;
        $certificado->fecha_ingreso=$request->inicio;
        $certificado->fecha_vence=$request->vence;
        $certificado->save();
        return response()->json($certificado);
    }

    public function store(CursoConductorRequest $request)
    {
        try{
        $registro=new CursoConductor();
        $registro->curso_id=$request->curso;
        $registro->conductor_id=$request->conductor;
        $registro->empresa_transporte_id=$request->empresa;
        $registro->carnet=$request->carnet;
        $registro->fecha_ingreso=$request->inicio;
        $registro->fecha_vence=$request->vence;
        $registro->save();
        $certificado=CursoConductor::with('Conductor','Curso')->find($registro->curso_id);
            return response()->json($certificado);
        }catch (\Exception $e){
            echo $e->getMessage();
        }

    }


    public function destroy($id)
    {
        $certificado=CursoConductor::find($id);
        $certificado->delete();
        return response()->json($id);
    }

    public function restore($id){
        $certificado=CursoConductor::withTrashed()->find($id);
        $certificado->restore();
        return response()->json($certificado);
    }

}
