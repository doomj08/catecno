<template>
    <div class="modal fade" :id="'create'+titulo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <label for="nombre" class="text-uppercase font-weight-bold col-xl-10">Crear {{titulo}}</label>
                    <button type="button" class="close col-xl-2" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div v-for="(campo,key) in campos" :key="key">

                    <div class="large-12 medium-12 small-12 cell">
                        <label>File
                            <input type="file" id="file" ref="file"
                                   v-on:change="handleFileUpload()"/>
                        </label>
                        <button v-on:click="submitFile()">Submit</button>
                    </div>
                    <f-input-component v-else
                            :label="campo.nombre"
                            :type="campo.tipo"
                            v-model="campo.value"
                            :lista="listas[campo.opciones]"
                            :class="campo.class"


                    >
                        <span class="text-danger span" v-for="error in errores[campo.nombre]">{{error}}</span>
                    </f-input-component>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar" @click="crear">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            titulo:{
                type:String,
                default:'Nombre de la tabla'
            },
            url:{
                type:String,
                default:'/#'
            },
            campos: {
                type: Array,
                default: []
            },
            listas: {
                type: Array,
                default: []
            }
        },
        data(){
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                errores:[],
                parametros:[],
                parametros2:[],
                file:''
            }
        },
        methods:{
            cargarEdicion(eEdicion){
                var fileReader=new FileReader()
                fileReader.readAsDataURL(eEdicion.target.files[0])
                fileReader.onload = (eEdicion)=>{
                    this.edicion_certiticado=eEdicion.target.result
                }
            },
            llenarparametros(){
                var jsonTexto='{';
                for (var i = 0; i < this.campos.length; i++)
                    jsonTexto=jsonTexto+'"'+this.campos[i].nombre+'":"'+this.campos[i].value+'",';
                jsonTexto=jsonTexto+'"_token":"'+this.csrf+'"}';
                console.log(jsonTexto)
                this.parametros = JSON.parse(jsonTexto); //conversion ok
            },
            limpiarparametros(){
                for (var i = 0; i < this.campos.length; i++)
                    this.campos[i].value='';
                    this.parametros = '';
            },
            crear(){
                this.llenarparametros()
                axios.post(this.url,this.parametros).then(
                    (res)=>{
                        console.log(res)
                    }).catch(e=>{
                    this.errores=e.response.data.errors;
                })
            },
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            }
        }
    }
</script>
