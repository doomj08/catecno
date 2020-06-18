<template>
    <div class="modal fade" id="subirpdf">
        <div class="modal-dialog">
            <div class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <label for="nombre" class="text-uppercase font-weight-bold col-xl-10">Crear {{titulo}}</label>
                    <button type="button" class="close col-xl-2" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                     <input  type="file" @change="cargar"/>
                <div class="modal-footer">
                    <input class="btn btn-primary" value="Guardar" @click="crear(titulo)">
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
        },
        data(){
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                errores:[],
                selectedFile:'',
                headers: {"Content-Type": "text/plain"},
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
            limpiarparametros(){
                this.parametros = '';
                this.errores=[];
            },
            crear(){
                const formData = new FormData();
                formData.append('file', this.selectedFile);  // appending file
                const config = {
                        headers: {
                            'content-type': 'multipart/form-data'
                        }
                        }
                axios.put(
                    this.url,
                    {file:this.selectedFile}
                ).then(
                    (res)=>{
                        this.limpiarparametros();
                        this.$emit('actualizardatos');
                        $('#subirpdf').modal('hide');
                        swal.fire('Certificado cargado correctamente','El certificado ha sido cargado satisfactoriamente','success');
                    }).catch(e=>{
                    this.errores=e.response.data.errors;
                })
            },
        }
    }
</script>
