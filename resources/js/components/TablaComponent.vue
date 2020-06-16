<template>
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{titulo}}</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th v-for="columna in columnas" class="uppercase" v-if="columna.alias">{{columna.alias}}</th>
                            <th v-else class="uppercase">{{columna.nombre}}</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th v-for="columna in columnas" class="uppercase" v-if="columna.alias">{{columna.alias}}</th>
                            <th v-else class="uppercase">{{columna.nombre}}</th>
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
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>

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
                default:'/#'
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
            }
        },
        methods:{
            consultar(){
                axios.get(this.url)
                    .then((res)=>{
                        this.items=res.data.tabla
                        this.listas=res.data.listas
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
