@extends('layouts.app')

@section('content')
    <tabla-component
            url="conductores"
            titulo="CONDUCTORES"
            :columnas="[
            {nombre:'id'    ,alias:'#'},
            {nombre:'cedula' ,alias:'DOCUMENTO DE IDENTIDAD'},
            {nombre:'Nombres' ,alias:'NOMBRES'},
            {nombre:'Apellidos' ,alias:'APELLIDOS'},
            {nombre:'created_at' ,alias:'FECHA DE CREACIÓN'},
            {nombre:'updated_at' ,alias:'FECHA DE ACTUALIZACIÓN'},
            {nombre:'updated_at' ,alias:'FECHA DE ACTUALIZACIÓN'},
        ]"
    ></tabla-component>
@endsection