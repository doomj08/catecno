<template>
    <div class="modal fade" :id="'create'+titulo">
        <div class="modal-dialog">
            <div class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <label for="nombre" class="text-uppercase font-weight-bold col-xl-10">Crear {{titulo}}</label>
                    <button type="button" class="close col-xl-2" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div v-for="(campo,key) in campos" :key="key" >
                    <f-input-component v-if="campo.tipo!='File'"
                                       :label="campo.nombre"
                                       :type="campo.tipo"
                                       :value="campo.value"
                                       v-model="campo.value"
                                       :lista="listas[campo.opciones]"
                                       :class="campo.class"
                    >
                        <span class="text-danger span" v-for="error in errores[campo.nombre]">{{error}}</span>
                    </f-input-component>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar" @click="crear(titulo)">
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
                default:'/'
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
                file:'',
                selectedFile:''
            }
        },
        methods:{
            cargar(e){
                var fileReader=new FileReader()
                fileReader.readAsDataURL(e.target.files[0])
                fileReader.onload = (e)=>{
                    this.selectedFile=e.target.result
                }
            },
            onFileChange(e) {
                const selectedFile = e.target.files[0]; // accessing file
                this.selectedFile = selectedFile;
                this.$emit('fileupdate', selectedFile)  // 1. Emitting
            },
            llenarparametros(){
                const config = { headers: { 'Content-Type': 'multipart/form-data' } };
                var jsonTexto='{';
                for (var i = 0; i < this.campos.length; i++){
                    if(this.campos[i].tipo=='File')
                        jsonTexto=jsonTexto+'"'+this.campos[i].nombre+'":"'+this.selectedFile+'",';
                    else
                        jsonTexto=jsonTexto+'"'+this.campos[i].nombre+'":"'+this.campos[i].value+'",';
                }
                jsonTexto=jsonTexto+'"Content-Type":"multipart/form-data",';
                jsonTexto=jsonTexto+'"_token":"'+this.csrf+'"}';
                console.log(jsonTexto)
                this.parametros = JSON.parse(jsonTexto); //conversion ok
            },
            limpiarparametros(){
                for (var i = 0; i < this.campos.length; i++)
                    this.campos[i].value='';
                this.parametros = '';
                this.errores=[];
            },
            crear(titulo){
                const formData = new FormData();
                for (var i = 0; i < this.campos.length; i++)
                    if(this.campos[i].tipo!='File')
                        formData.append(this.campos[i].nombre, this.campos[i].value);  // appending file
                    else
                        formData.append(this.campos[i].nombre, this.selectedFile);  // appending file

                        formData.append('_token', this.csrf);  // appending file
                axios.post(
                    this.url,
                    formData,
                ).then(
                    (res)=>{
                        this.limpiarparametros();
                        this.$emit('actualizardatos');
                        $('#create'+titulo).modal('hide');
                        swal.fire('Registro creado','Los datos fueron creados correctamente','success');
                    }).catch(e=>{
                        console.log(e.response)
                    this.errores=e.response.data.errors;
                })
            },
            handleFileUpload(key){
                //console.log(key)
                this.campos[key].value=this.$refs.file.files[0];
                console.log(this.campos[key])
                //this.file = this.$refs.file.files[0];
            }
        }
    }
</script>
