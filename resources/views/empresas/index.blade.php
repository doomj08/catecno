@extends('layouts.app')

@section('content')
    <tabla-component
            url="empresas"
            titulo="EMPRESAS"
            :columnas="[
            {nombre:'id'    ,alias:'#'},
            {nombre:'Razon_social' ,alias:'RAZÓN SOCIAL'},
            {nombre:'created_at' ,alias:'FECHA DE CREACIÓN'},
            {nombre:'updated_at' ,alias:'FECHA DE ACTUALIZACIÓN'},
            {nombre:'updated_at' ,alias:'FECHA DE ACTUALIZACIÓN'},
        ]"
    ></tabla-component>
@endsection