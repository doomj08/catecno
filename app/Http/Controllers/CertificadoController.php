<?php

namespace App\Http\Controllers;

use App\Conductor;
use App\CursoConductor;
use App\Http\Requests\CertificadoRequest;;

use App\Http\Requests\PdfRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CertificadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('certificados');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function certificados(Request $request)
    {

        if($request->ajax()){
            $date = Carbon::now();
            $date = $date->format('Y-m-d');
            $conductor=Conductor::where('cedula',$request->cedula)
                ->with('CursoConductor','CursoConductor.Curso')
                ->with('Institucion')
                ->get()->first();
            return $conductor;
            if(!$conductor)
                $conductor=Conductor::where('cedula',$request->cedula)->with('Institucion')->get()->first();

            if(!$conductor){
                return response()->json(['conductor'=>'','message'=>'El número del documento no se encuentra registrado.']);
            }else{
                return response()->json(['conductor'=>$conductor,'message'=>'']);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PdfRequest $request)
    {
        //return $request->cedula;
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        $conductor=Conductor::where('cedula',$request->cedula)
            ->with('CursoConductor','CursoConductor.Curso')
            ->with('Institucion')
            ->get()->first();
        if(!$conductor)
            $conductor=Conductor::where('cedula',$request->cedula)->with('Institucion')->get()->first();
        return $conductor;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            $conductor=CursoConductor::where('certificado',$id)->get()->first();
        //return $conductor;
        if(!$conductor){
            return response()->json(['conductor'=>'','message'=>'El número del documento no se encuentra registrado.']);
        }else{
            return Storage::disk('certificados')->download($conductor->certificado);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CertificadoRequest $request, $id)
    {
        //return $request;
     //   if ($request->file('file')->isValid()) {
        $base64_image = $request->input('file'); // your base64 encoded
        @list($type, $file_data) = explode(';', $base64_image);
        @list(, $file_data) = explode(',', $file_data);
        $imageName = time().'.'.'pdf';
        $path=$imageName;
        $cursoconductor=CursoConductor::find($id);
        $cursoconductor->certificado=$path;
        $cursoconductor->pdf=$base64_image;
        $cursoconductor->save();
        Storage::disk('certificados')->put($imageName, base64_decode($file_data));
     //   }
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
