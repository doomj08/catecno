<template>
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800"></h1>

        <!-- DataTales Example -->
        <spinner-component v-if="cargando"></spinner-component>
        <div v-else class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{titulo}}
                    <a href="#" class="btn btn-primary pull-right" data-toggle="modal" :data-target="'#create'+titulo">
                        Nuevo Registro
                    </a></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th v-for="columna in columnas" class="uppercase" v-if="columna.alias">{{columna.alias}}</th>
                            <th v-else class="uppercase">{{columna.nombre}}</th>
                            <th class="uppercase">ACCIONES</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th v-for="columna in columnas" class="uppercase" v-if="columna.alias">{{columna.alias}}</th>
                            <th v-else class="uppercase">{{columna.nombre}}</th>
                            <th class="uppercase">ACCIONES</th>
                        </tr>
                        </tfoot>
                        <tbody >
                        <tr v-for="item in items" >
                            <td v-for="columna in columnas"
                                class="uppercase"
                                v-if="item[columna.nombre]&&columna.subcolumna&&columna.subcolumna2"
                            >
                                {{item[columna.nombre][columna.subcolumna]}} {{item[columna.nombre][columna.subcolumna2]}}
                            </td>
                            <td v-else-if="item[columna.nombre]&&columna.subcolumna">{{item[columna.nombre][columna.subcolumna]}}</td>
                            <td v-else>{{item[columna.nombre]}}</td>
                            <td class="inline-block">
                                <button class="btn btn-primary btn-circle " @click="editarcampos(item)"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-circle "  @click="eliminar(item.id)"><i class="fa fa-edit"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>
            <crear-component
                    :titulo=titulo
                    :campos=campos
                    :url="url"
                    :listas="listas"
                    @actualizardatos="consultar()"
            ></crear-component>
            <editar-component
                    :titulo=titulo
                    :campos=campos
                    :url="url"
                    :listas="listas"
                    @actualizardatos="consultar()"
                    :camposeditados="camposeditados"
            ></editar-component>
        </div>
    </div>
    <!-- /.container-fluid -->


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
                listas:'',
                errores:[],
                cargando:true,
                camposeditados:[]
            }
        },
        methods:{

            consultar(){
                this.cargando=true;
                axios.get(this.url)
                    .then((res)=>{
                        this.items=res.data.tabla
                        this.listas=res.data.listas
                        this.cargando=false;
                        this.camposeditados="";
                    })
                    .catch(e => {
                        this.errores=e.response.data.errors;
                    });
            },
            editarcampos(item){
                this.camposeditados=item
                console.log(item)
                console.log(this.camposeditados)
                $('#editcomponent').modal('show');
            },
            eliminar(id){
                swal.fire({
                    type: 'success',
                    title: 'User Added successfully'
                })
                this.cargando=true;
                axios.delete(this.url+'/'+id)
                    .then((res)=>{
                        this.cargando=false;
                        this.consultar();
                    })
                    .catch(e => {
                        this.errores=e.response.data.errors;
                    });
            }
        },
        mounted() {
            this.consultar();
        },
    }
</script>
