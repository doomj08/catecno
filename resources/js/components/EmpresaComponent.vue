<template>
    <tabla-component
            url="empresas"
            titulo="EMPRESAS"
            :columnas="[
            {nombre:'id'    ,alias:'#'},
            {nombre:'razon_social' ,alias:'RAZÓN SOCIAL'},
            {nombre:'created_at' ,alias:'FECHA DE CREACIÓN'},
            {nombre:'updated_at' ,alias:'FECHA DE ACTUALIZACIÓN'},
            {nombre:'updated_at' ,alias:'FECHA DE ACTUALIZACIÓN'},
        ]"
            :campos="[
            {nombre: 'razon_social',                alias:'curso',          tipo: 'String', value:'',                  class:'col-sm-12'},
        ]"
    ></tabla-component>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
