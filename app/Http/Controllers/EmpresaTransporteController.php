<?php

namespace App\Http\Controllers;

use App\EmpresaTransporte as Table;
use App\Http\Requests\EmpresaRequest;
use Illuminate\Http\Request;

class EmpresaTransporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return view('empresas.index');
    }
    public function store(EmpresaRequest $request)
    {
        Table::create($request->all());
        return;
    }

    public function update(EmpresaRequest $request)
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
