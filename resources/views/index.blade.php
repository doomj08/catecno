@extends('layouts.app')

@section('content')
    <tabla-component
            :columnas="[
            {nombre:'id'    ,alias:'#'},
            {nombre:'curso' ,alias:'curso', subtabla:'curso', subcolumna:'nombre'},
            {nombre:'carnet'},
            {nombre:'conductor' ,alias:'conductor', subtabla:'conductor', subcolumna:'Nombres', subcolumna2:'Apellidos'},
            {nombre:'fecha_ingreso' ,alias:'fecha de ingreso'},
            {nombre:'fecha_vence' ,alias:'fecha de vencimiento'},
        ]"
    ></tabla-component>
@endsection