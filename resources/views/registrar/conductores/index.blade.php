@extends('layouts.app_panel')
@section('content')
    <div id="app">
        <div class="row">
            <div class="col-lg-10">
                <h1 class="page-header">Conductores</h1>
            </div>

        </div>
        <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <div class="row">
                <div class="col-sm-9">
                    <div class="dataTables_length" id="dataTables-example_length">
                        <label>Mostrar
                            <select name="" id="" v-model="resource_url">
                                <option value="/conductores/paginas/10" >10</option>
                                <option value="/conductores/paginas/25">25</option>
                                <option value="/conductores/paginas/50">50</option>
                                <option value="/conductores/paginas/100">100</option>
                            </select> registros</label></div>
                </div>

                <div class="col-sm-3">
                    <button type="button" class="btn btn-default  " v-on:click="editar()"><i class="fa fa-plus"> Nuevo conductor</i>
                    </button>
                </div>
                <div class="col-sm-12">
                    <table class="table  table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid">
                        <thead >
                        <tr>
                            <th class="col">#</th>
                            <th class="column-title">Documento de identidad</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellidos</th>
                            <th class="col">Última modificación</th>
                            <th class="col">Fecha de eliminación</th>
                            <th class="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(conductor,index) in conductores" :key="index">
                            <td>@{{ conductor.id }}</td>
                            <td>@{{ conductor.cedula }}</td>
                            <td>@{{ conductor.Nombres }}</td>
                            <td>@{{ conductor.Apellidos }}</td>
                            <td>@{{ conductor.updated_at }}</td>
                            <td>@{{ conductor.deleted_at }}</td>
                            <td>
                                <button type="button" class="btn btn-default btn-circle " v-on:click="editar(conductor.id,index)"><i class="fa fa-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-circle "  v-if="(!conductor.deleted_at)" v-on:click="eliminar(conductor.id)"><i class="fa fa-trash"></i>
                                <button type="button" class="btn btn-default btn-circle " v-else v-on:click="restaurar(conductor.id,index)"><i class="fa fa-undo"></i>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <v-paginator :options="options" :resource_url="resource_url" @update="val => conductores = val"></v-paginator>
                </div>
            </div>
        </div>
        @include('registrar.conductores.registrar')
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.2.0/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.5.0/vue-resource.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vuejs-paginator/2.0.0/vuejs-paginator.js"></script>

    <script>
        Vue.use(VueResource)
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;

        var vuejs = new Vue({
            el: '#app',
            data: {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                url:"/conductores",
                resource_url: '/conductores/paginas/10',
                options: {
                    remote_data: 'data',
                  //  remote_current_page: 'nested.current_page',
                  //  remote_last_page: 'nested.last_page',
                  //  remote_next_page_url: 'nested.next_page_url',
                  //  remote_prev_page_url: 'nested.prev_page_url',
                    next_button_text: 'Siguiente',
                    previous_button_text: 'Anterior'
                },
                registroEnEdicion:{
                    cedula:"",
                    Nombres:"",
                    Apellidos:"",
                },
                indexEnEdicion:'',
                nuevoRegistro:{
                    estado:1,
                },

                conductores:{},
                errores:{ "message": {}, "errors": {
                    cedula:'',
                    nombres:'',
                    apellidos:'',
                    } },
            },
            components: {
                VPaginator: VuePaginator
            },
            methods: {
                updateResource(data){
                    this.conductores = ""
                },

                editar:function (id=null,index=null) {
                    this.indexEnEdicion=index;
                    this.errores={"message": {}, "errors":{
                            cedula:'',
                            nombres:'',
                            apellidos:'',
                        } };
                    if(id==null){
                        this.indexEnEdicion='';
                        this.nuevoRegistro.estado=1;
                        this.registroEnEdicion={};
                    }else{
                        this.indexEnEdicion=index;
                        this.nuevoRegistro.estado=0;
                        this.$http.get(this.url+'/'+id).then(response=>{
                            this.registroEnEdicion=response.body;
                            console.log(this.registroEnEdicion);
                        }).then(error=>{
                            console.log(error);
                        });
                    }
                    $('#conductor').modal('show');
                },

                guardar:function () {
                    console.log(this.csrf);
                    if(this.nuevoRegistro.estado==0){
                        this.$http.put(this.url+'/'+this.registroEnEdicion.id, {
                            _token: this.csrf,
                            cedula: this.registroEnEdicion.cedula,
                            nombres: this.registroEnEdicion.Nombres,
                            apellidos: this.registroEnEdicion.Apellidos,
                        }).then(response=>{
                            this.conductores[this.indexEnEdicion]=response.body;
                            this.conductores.push();
                        $('#conductor').modal('hide');
                        }).catch(error=>{
                            this.errores.errors=error.data.errors;
                    });
                    }else{
                        this.$http.post(this.url,{
                                _token: this.csrf,
                                cedula: this.registroEnEdicion.cedula,
                                nombres: this.registroEnEdicion.Nombres,
                                apellidos: this.registroEnEdicion.Apellidos,
                            }
                        ).then(response=>{
                            this.conductores.push(response.body);
                            console.log(response);
                            $('#conductor').modal('hide');
                        }).catch(error=>{
                            this.errores.errors=error.data.errors;
                        });
                    }

                },

                eliminar:function (id) {
                        this.$http.delete(this.url+'/'+id, {
                        params: {
                            _token: this.csrf,
                        }
                    }).then(response=>{
                        console.log(response);
                        $('#conductor').modal('hide');
                    }).catch(error=>{
                        this.errores=error.data;
                    });
                },

                restaurar:function (id,index) {
                    this.indexEnEdicion=index;
                    this.$http.post(this.url+'/restore/'+id, {
                        params: {
                            _token: this.csrf,
                        }
                    }).then(response=>{
                        this.cursos[this.indexEnEdicion]=response.body;
                        this.cursos.push();
                        console.log("registro restaurado");
                    }).catch(error=>{
                        console.log(error);
                    });
                    this.indexEnEdicion="";
                }
            },
        });
    </script>
@endsection