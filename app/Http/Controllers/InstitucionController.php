<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstitucionRequest;
use App\Institucion as Table;
use Illuminate\Http\Request;

class InstitucionController extends Controller
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
        return view('instituciones.index');
    }

    public function store(InstitucionRequest $request)
    {
        Table::create($request->all());
        return;
    }

    public function update(InstitucionRequest $request)
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
