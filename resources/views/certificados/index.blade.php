@extends('layouts.panel')

@section('content')
    <tabla-component
            url="certificados"
            titulo="CERTIFICADOS"
            mayus="true"
            :columnas="[
            {nombre:'id'    ,alias:'#'},
            {nombre:'curso' ,alias:'CURSO', subtabla:'curso', subcolumna:'nombre'},
            {nombre:'carnet', alias:'CARNET'},
            {nombre:'certificado', alias:'CERTIFICADO', urlarchivo:'pdf'},
            {nombre:'conductor' ,alias:'CONDUCTOR', subtabla:'conductor', subcolumna:'nombres', subcolumna2:'apellidos'},
            {nombre:'fecha_ingreso' ,alias:'FECHA DE INGRESO'},
            {nombre:'fecha_vence' ,alias:'FECHA DE VENCIMIENTO'},
            {nombre:'updated_at' ,alias:'ÚLTIMA MODIFICACIÓN'},
        ]"
            :campos="[
            {nombre: 'curso_id',                alias:'curso',          tipo: 'Select', value:'',   opciones:'cursos',              class:'col-sm-12'},
            {nombre: 'carnet',                  alias:'carnet',   tipo: 'String', value:'',                                   class:'col-sm-12'},
            {nombre: 'conductor_id',            alias:'conductor',      tipo: 'Select', value:'',   opciones:'conductores',         class:'col-sm-12'},
            {nombre: 'fecha_ingreso',           alias:'fecha ingreso',   tipo: 'Date',   value:'',                                   class:'col-sm-12'},
            {nombre: 'fecha_vence',             alias:'fecha vencimiento',   tipo: 'Date',   value:'',                                   class:'col-sm-12'},
            {nombre: 'empresa_transporte_id',   alias: 'empresa transportadora',  tipo: 'Select', value:'',   opciones:'empresas_transporte', class:'col-sm-12'},
            {nombre: 'certificado',                    alias:'Certificado PDF',   tipo: 'File',   value:'',                                   class:'col-sm-12'},
            ]"
    ></tabla-component>
@endsection