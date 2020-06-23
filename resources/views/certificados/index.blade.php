@extends('layouts.panel')

@section('content')
    <tabla-component
            url="certificados"
            titulo="CERTIFICADOS"
            :columnas="[
            {nombre:'id'    ,alias:'#'},
            {nombre:'curso' ,alias:'Curso', subtabla:'curso', subcolumna:'nombre'},
            {nombre:'carnet', alias:'Carnet'},
            {nombre:'certificado', alias:'Certificado', urlarchivo:'pdf'},
            {nombre:'conductor' ,alias:'Conductor', subtabla:'conductor', subcolumna:'nombres', subcolumna2:'apellidos'},
            {nombre:'fecha_ingreso' ,alias:'Fecha de ingreso'},
            {nombre:'fecha_vence' ,alias:'Fecha de vencimiento'},
            {nombre:'updated_at' ,alias:'Modificado'},
        ]"
            :campos="[
            {nombre: 'curso_id',                alias:'curso',          tipo: 'Select', value:'',   opciones:'cursos',  urlaux:'cursos',          class:'col-sm-12'},
            {nombre: 'carnet',                  alias:'carnet',   tipo: 'String', value:'',                                   class:'col-sm-12'},
            {nombre: 'conductor_id',            alias:'conductor',      tipo: 'Select', value:'',   opciones:'conductores', urlaux:'conductores',         class:'col-sm-12'},
            {nombre: 'fecha_ingreso',           alias:'fecha ingreso',   tipo: 'Date',   value:'',                                   class:'col-sm-12'},
            {nombre: 'fecha_vence',             alias:'fecha vencimiento',   tipo: 'Date',   value:'',                                   class:'col-sm-12'},
            {nombre: 'empresa_transporte_id',   alias: 'empresa transportadora',  tipo: 'Select', value:'',   opciones:'empresas_transporte', class:'col-sm-12'},
            {nombre: 'certificado',                    alias:'Certificado PDF',   tipo: 'File',   value:'',                                   class:'col-sm-12'},
            ]"
    ></tabla-component>
@endsection