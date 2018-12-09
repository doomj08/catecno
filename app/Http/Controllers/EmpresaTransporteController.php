<?php

namespace App\Http\Controllers;

use App\EmpresaTransporte;
use App\Http\Requests\EmpresaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaTransporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('registrar/empresas/index');
    }

    public function paginate($index){
        if(Auth::user()->id==1)
            $empresas=EmpresaTransporte::withTrashed()->orderBy('id','desc')->paginate($index);
        else
            $empresas=EmpresaTransporte::orderBy('id','desc')->paginate($index);
        return response()->json($empresas);
    }

    public function show($id){
        $empresas=EmpresaTransporte::find($id);
        return response()->json($empresas);
    }

    public function update($id,EmpresaRequest $request){
        $empresas=EmpresaTransporte::find($id);
        $empresas->Razon_social=ucwords($request->razon_social);
        $empresas->save();
        return response()->json($empresas);
    }

    public function store(EmpresaRequest $request){
        try{
            $registro=new EmpresaTransporte();
            $registro->Razon_social=ucwords(strtolower ($request->razon_social));
            $registro->save();
            return response()->json($registro);
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public function destroy($id){
        $empresa=EmpresaTransporte::find($id);
        $empresa->delete();
        return response()->json($id);
    }

    public function restore($id){
        $empresa=EmpresaTransporte::withTrashed()->find($id);
        $empresa->restore();
        return response()->json($empresa);
    }
}
