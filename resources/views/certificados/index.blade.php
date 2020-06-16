@extends('layouts.app')

@section('content')
    <tabla-component
            url="certificados"
            titulo="CERTIFICADOS"
            :columnas="[
            {nombre:'id'    ,alias:'#'},
            {nombre:'curso' ,alias:'CURSO', subtabla:'curso', subcolumna:'nombre'},
            {nombre:'carnet', alias:'CARNET'},
            {nombre:'conductor' ,alias:'CONDUCTOR', subtabla:'conductor', subcolumna:'Nombres', subcolumna2:'Apellidos'},
            {nombre:'fecha_ingreso' ,alias:'FECHA DE INGRESO'},
            {nombre:'fecha_vence' ,alias:'FECHA DE VENCIMIENTO'},
            {nombre:'updated_at' ,alias:'ÚLTIMA MODIFICACIÓN'},
        ]"
    ></tabla-component>
@endsection