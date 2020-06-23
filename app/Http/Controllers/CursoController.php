<?php

namespace App\Http\Controllers;

use App\Curso as Table;
use App\Curso;
use App\Http\Requests\CursoRequest;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $items=Table::paginate(10);
            //$list=Curso::pluck('id','id')->toArray();
            return [
                'tabla'=>$items,
                'pagination'=>[
                    'total'=>$items->total(),
                    'per_page'=>$items->perPage(),
                    'current_page'=>$items->currentPage(),
                    'last_page'=>$items->lastPage(),
                    'from'=>$items->firstItem(),
                    'to'=>$items->lastItem(),
                ]
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
    public function lista(Curso $conductor)
    {
        $list1=Curso::orderby('id','desc')->pluck('id','nombre');
        return $list1;
        return;
    }
}
