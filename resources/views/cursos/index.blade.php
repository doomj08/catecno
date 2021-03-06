@extends('layouts.panel')

@section('content')
    <tabla-component
            url="cursos"
            titulo="CURSOS"
            :columnas="[
            {nombre:'id'    ,alias:'#'},
            {nombre:'nombre' ,alias:'NOMBRE DEL CURSO'},
            {nombre:'created_at' ,alias:'FECHA DE CREACIÓN'},
            {nombre:'updated_at' ,alias:'FECHA DE ACTUALIZACIÓN'},
        ]"
            :campos="[
            {nombre: 'nombre',                alias:'curso',          tipo: 'String', value:'',                  class:'col-sm-12'},
        ]"
    ></tabla-component>
@endsection