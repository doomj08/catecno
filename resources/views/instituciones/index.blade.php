@extends('layouts.panel')

@section('content')
    <tabla-component
            url="instituciones"
            titulo="INSTITUCIONES"
            :columnas="[
            {nombre:'id'    ,alias:'#'},
            {nombre:'nombre' ,alias:'NOMBRE DEL INSTITUTO'},
            {nombre:'updated_at' ,alias:'ÚLTIMA MODIFICACIÓN'},
        ]"
            :campos="[
            {nombre: 'nombre',                  alias:'nombre del instituto',   tipo: 'String', value:'',                                   class:'col-sm-12'},
            ]"
    ></tabla-component>
@endsection