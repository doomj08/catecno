<?php

namespace App\Http\Controllers;

use App\Curso as Table;
use App\Http\Requests\CursoRequest;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $items=Table::get();
            //$list=Curso::pluck('id','id')->toArray();
            return [
                'tabla'=>$items,
                //  'listas'=>$list
            ];
        }
        return view('cursos.index');
    }

    public function store(CursoRequest $request)
    {
        Table::create($request->all());
        return;
    }

    public function update(Request $request)
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
