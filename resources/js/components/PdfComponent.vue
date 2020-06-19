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
                    <div class="componente" >
                        <div class="form">
                            <li>{{titulo}}</li>
                            <input  type="file" id="filepdf" @change="cargar"/>
                            <span class="text-danger span" v-for="error in errores['file']">{{error}}</span>
                        </div>
                    </div>





                <div class="modal-footer">
                    <input class="btn btn-primary" value="Guardar" @click="crear(titulo)">
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .componente{
        padding: 2px 0px 2px 2px;
    }
    .form{
        border: 1px solid gray;
        margin: 3px 10px 3px 10px;
        padding: 10px 10px 10px 10px;
        background: transparent;
    }

    .form li{
        list-style: none;
        color: rgba(29, 104, 167, 0.81);
        font-weight: bold;
        text-transform: uppercase;
        font-size: 11px;
    }
    .campo{
        width: 100%;
        height: 25px;
        color: #363b40;
        font-size: 14px;
        border-style: solid;
        border-color:  rgba(29, 104, 167, 0.81);
        background: transparent;
        text-transform: uppercase;
    }
    input{
        border-top: 0px;
        border-left: 0px;
        border-right: 0px;
    }
    select{
        border-top: 0px;
        border-left: 0px;
        border-right: 0px;
        border-bottom: 2px;
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
                var input = $('#filepdf');
                var clon = input.clone();  // Creamos un clon del elemento original
                input.replaceWith(clon);   // Y sustituimos el original por el clon
                this.selectedFile=''

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
