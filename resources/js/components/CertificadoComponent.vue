<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <f-input-component
                                           :label="titulo"
                                           type="Number"
                                           v-model="value"
                                           :class="col-sm-12"
                        >

                        </f-input-component>
                        <span class="text-danger span" v-for="error in errores['cedula']">{{error}}</span>
                        <input class="btn btn-primary col-sm-12" value="Guardar" @click="consultar()">
                    </div>

                    <div class="card-body">
                        I'm an example componentsss.
                    </div>
                    <div class="card-body">
                        I'm an example componentsss.
                    </div>
                    <div class="card-body">
                        I'm an example componentsss.
                    </div>
                    <div class="card-body">
                        I'm an example componentsss.
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
                items:[{}],
                errores:[],
                cargando:true,
                value:'',
            }
        },
        methods:{
            consultar(){
                this.cargando=true;
                console.log('consultando')
                axios.post(this.url
                    ,
                    {cedula:this.value}
                    )
                    .then((res)=>{
                        this.items=res.data.tabla
                        this.listas=res.data.listas
                        this.cargando=false;
                        this.camposeditados="";
                        this.errores='';
                    })
                    .catch(e => {
                        this.errores=e.response.data.errors;
                    });
            },
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
