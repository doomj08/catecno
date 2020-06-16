@extends('layouts.app')

@section('content')
    <tabla-component
            url="cursos"
            titulo="CURSOS"
            :columnas="[
            {nombre:'id'    ,alias:'#'},
            {nombre:'nombre' ,alias:'NOMBRE DEL CURSO'},
            {nombre:'created_at' ,alias:'FECHA DE CREACIÓN'},
            {nombre:'updated_at' ,alias:'FECHA DE ACTUALIZACIÓN'},
            {nombre:'updated_at' ,alias:'FECHA DE ACTUALIZACIÓN'},
        ]"
    ></tabla-component>
@endsection