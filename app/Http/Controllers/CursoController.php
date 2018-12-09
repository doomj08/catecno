<?php

namespace App\Http\Controllers;

use App\Curso;

use Illuminate\Http\Request;
use App\Http\Requests\CursoRequest;
use Illuminate\Support\Facades\Auth;

class CursoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('registrar/cursos/index');
    }

    public function paginate($index){
        if(Auth::user()->id==1)
            $cursos=Curso::withTrashed()->orderBy('id','desc')->paginate($index);
        else
            $cursos=Curso::orderBy('id','desc')->paginate($index);
        return response()->json($cursos);
    }

    public function show($id){
        $cursos=Curso::find($id);
        return response()->json($cursos);
    }

    public function update($id,CursoRequest $request){
        $curso=Curso::find($id);
        $curso->nombre=ucwords($request->nombre);
        $curso->save();
        return response()->json($curso);
    }

    public function store(CursoRequest $request){
        try{
            $registro=new Curso();
            $registro->nombre=ucwords(strtolower ($request->nombre));
            $registro->save();
            return response()->json($registro);
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public function destroy($id){
        $curso=Curso::find($id);
        $curso->delete();
        return response()->json($id);
    }

    public function restore($id){
        $curso=Curso::withTrashed()->find($id);
        $curso->restore();
        return response()->json($curso);
    }


}
