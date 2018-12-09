<?php

namespace App\Http\Controllers;

use App\Conductor;
use Illuminate\Http\Request;
use App\Http\Requests\ConductorRequest;
use Illuminate\Support\Facades\Auth;

class ConductorController extends Controller
{
    //
    public function index(){
        return view('registrar/conductores/index');
    }

    public function paginate($index){
        if(Auth::user()->id==1)
            $conductores=Conductor::withTrashed()->orderBy('id','desc')->paginate($index);
        else
            $conductores=Conductor::orderBy('id','desc')->paginate($index);
        return response()->json($conductores);
    }

    public function show($id){
        $conductores=Conductor::find($id);
        return response()->json($conductores);
    }

    public function update($id,ConductorRequest $request){
        //return response($id);
        //return response()->json($request);
        $conductor=Conductor::find($id);
        $conductor->cedula=$request->cedula;
        $conductor->institucion_id=1;
        $conductor->Nombres=ucwords(strtolower ($request->nombres));
        $conductor->Apellidos=ucwords(strtolower ($request->apellidos));
        $conductor->save();
        return response()->json($conductor);
    }

    public function store(ConductorRequest $request){
        try{
            $registro=new Conductor();
            $registro->cedula=$request->cedula;
            $registro->institucion_id=1;
            $registro->Nombres=ucwords(strtolower ($request->nombres));
            $registro->Apellidos=ucwords(strtolower ($request->apellidos));
            $registro->save();
            return response()->json($registro);
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public function destroy($id){
        $conductor=Conductor::find($id);
        $conductor->delete();
        return response()->json($conductor);
    }

    public function restore($id){
        $conductor=Conductor::withTrashed()->find($id);
        $conductor->restore();
        return response()->json($conductor);
    }
}
