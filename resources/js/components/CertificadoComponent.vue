<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <f-input-component :label="titulo"
                                           type="Number"
                                           v-model="value"
                                           class="col-sm-12"
                        >

                        </f-input-component>
                        <span class="text-danger span" v-for="error in errores['cedula']">{{error}}</span>
                        <input type="button" class="btn-primary col-sm-12" value="Consultar" @click="consultar()">
                    </div>

                    <div class="card-body" v-if="consultando">
                        <spinner-component v-if="cargando" >
                        </spinner-component>
                        <div class="card-body" v-else>
                            <ul class="form form-header">

                                    <li>{{conductor.nombres}} {{conductor.apellidos}}</li>

                                    <li>C.C: {{conductor.cedula}}</li>


                                    <li>Institución: {{conductor.institucion.nombre}}</li>

                            </ul>
                            <ul class="form form-body col-md-12" v-for="curso in cursos" style="display: inline-block">
                                <li>Curso: {{curso.curso.nombre}}</li>
                                <li>Carnet: {{curso.carnet}}</li>
                                <li>Fecha de inicio: {{curso.fecha_ingreso}}</li>
                                <li>Fecha de vencimiento: {{curso.fecha_vence}}</li>
                                <li>
                                    <a :href="url+'/'+curso.certificado" v-if="curso.certificado">Descargar certificado</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    body {
        width:600px;
        background-color: white;
        padding: 3px;
        display: inline-block;
        margin: 5px auto;
        float: center;
    }
    li {
        list-style: none;
        text-transform: uppercase;
        font-family: "Times New Roman", Times, serif;

    }
    .panel{
        border: 1px solid gray;
    }
    .componente{
        padding: 2px 0px 2px 2px;
    }
    input[type=button]{
        background:#31A3DD;
        border: 0px solid cornflowerblue;
    }
    .form{
        border: 1px solid gray;
        margin: 0px 0px 10px 0px;
        padding: 10px 10px 10px 10px;
        background: transparent;
    }

    .form li{
        list-style: none;
        color: rgba(54, 59, 64, 0.81);
        font-weight: bold;
        text-transform: uppercase;
        font-size: 12px;
    }
    .form-header{
        text-align: justify;
        border: 0px solid black;
    }
    .form-body{
        height: 90px;
    }
    .span{
        display: block;
    }
</style>
<script>
    export default {
        props:{
            titulo:{
                type:String,
                default:'Nombre de la tabla'
            },
            url:{
                type:String,
                default:'/'
            },
            campos:{
                type:Array,
                default:[{nombre: 'id', tipo: 'Number',value:''},]
            },
            columnas:{
                type:Array,
                default:[{nombre: 'columna'}]
            },
        },
        data: function () {
            return {
                items:'',
                errores:[],
                cargando:true,
                consultando:false,
                value:'',
                conductor:'',
                cursos:''
            }
        },
        methods:{
            consultar(){
                this.cargando=true;
                this.consultando=true;
                console.log('consultando')
                axios.post(this.url
                    ,
                    {cedula:this.value}
                    )
                    .then((res)=>{
                        this.conductor=res.data;
                        this.cursos=res.data.curso_conductor;
                        this.cargando=false;
                        this.errores='';
                    })
                    .catch(e => {
                        this.errores=e.response.data.errors;
                        this.cargando=false;
                        this.consultando=false;
                        this.conductor='';
                        this.cursos='';
                    });
            },
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
