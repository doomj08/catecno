<template>
    <div class="modal fade" :id="'editcomponent'">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <label for="nombre" class="text-uppercase font-weight-bold col-xl-10">Editando {{titulo}}</label>
                    <button type="button" class="close col-xl-2" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div v-for="(campo,key) in campos" :key="key">
                    <f-input-component v-if="campo.tipo!='File'"
                            :label="campo.nombre"
                            :type="campo.tipo"
                            :lista="listas[campo.opciones]"
                            :valorheredado="camposeditados[campo.nombre]"
                            v-model="camposeditados[campo.nombre]"
                            :class="campo.class"
                    >
                        <span class="text-danger span" v-for="error in errores[campo.nombre]">{{error}}</span>
                    </f-input-component>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar" @click="editar()">
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
            },
            camposeditados: {
                type: Array,
                default: []
            }
        },
        data(){
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                errores:[],
                parametros:[],
                editarcampos:[],
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
            llenarparametros(){

            },
            limpiarparametros(){
                this.parametros = "";
                this.camposeditados = "";
                this.errores="";
            },
            editar(id){
                const formData = new FormData();
                for (var i = 0; i < this.campos.length; i++)
                    if(this.campos[i].tipo=='File')
                        formData.append(this.campos[i].nombre, this.selectedFile);  // appending file


                axios.put(this.url+'/'+this.camposeditados.id,this.camposeditados).then(
                    (res)=>{
                        this.$emit('actualizardatos');
                        this.limpiarparametros();
                        $('#editcomponent').modal('hide');
                        swal.fire('Registro guardado','Los datos fueron actualizados correctamente','success');
                    }).catch(e=>{
                    console.log(e.response)
                    this.errores=e.response.data.errors;
                })
            },
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            }
        }
    }
</script>