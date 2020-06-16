@extends('layouts.app')

@section('content')
    <tabla-component
            url="conductores"
            titulo="CONDUCTORES"
            :columnas="[
            {nombre:'id'    ,alias:'#'},
            {nombre:'cedula' ,alias:'DOCUMENTO DE IDENTIDAD'},
            {nombre:'nombres' ,alias:'NOMBRES'},
            {nombre:'apellidos' ,alias:'APELLIDOS'},
            {nombre:'created_at' ,alias:'FECHA DE CREACIÓN'},
            {nombre:'updated_at' ,alias:'FECHA DE ACTUALIZACIÓN'},
            {nombre:'updated_at' ,alias:'FECHA DE ACTUALIZACIÓN'},
        ]"
            :campos="[
            {nombre: 'cedula',                alias:'CÉDULA',          tipo: 'Number', value:'',                  class:'col-sm-8'},
            {nombre: 'nombres',                alias:'NOMBRES',          tipo: 'String', value:'',                  class:'col-sm-8'},
            {nombre: 'apellidos',                alias:'APELLIDOS',          tipo: 'String', value:'',                  class:'col-sm-8'},
        ]"
    ></tabla-component>
@endsection