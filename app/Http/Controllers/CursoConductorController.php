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
            $items=Table::with('Curso','EmpresaTransporte','Conductor')->orderby('id','asc')->get();
            $list1=Conductor::pluck('nombres','id');
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

    public function store(CursoConductorRequest $request)
    {
        //return $request;
        $base64_image = $request->input('certificado'); // your base64 encoded
        @list($type, $file_data) = explode(';', $base64_image);
        @list(, $file_data) = explode(',', $file_data);
        $imageName = time().'.'.'pdf';
        $path=$imageName;
        $request['pdf']=$base64_image;
        $request['certificado']=$path;

        Table::create($request->all());
        Storage::disk('certificados')->put($imageName, base64_decode($file_data));
        return;
    }

    public function update(CursoConductorRequest $request)
    {
        $base64_image = $request->input('certificado'); // your base64 encoded
        @list($type, $file_data) = explode(';', $base64_image);
        @list(, $file_data) = explode(',', $file_data);
        $imageName = time().'.'.'pdf';
        $path=$imageName;
        $request['pdf']=$base64_image;
        $request['certificado']=$path;

        Table::findOrFail($request->id)->update($request->all());
        return;
    }

    public function destroy($id)
    {
        Table::findOrFail($id)->delete();
        return;
    }
}
