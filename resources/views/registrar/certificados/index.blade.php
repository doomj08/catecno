@extends('layouts.app_panel')
@section('content')
    <div id="app">
        <div class="row">
            <div class="col-lg-10">
                <h1 class="page-header">Certificados</h1>
            </div>

        </div>
        <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <div class="row">
                <div class="col-sm-9">
                    <div class="dataTables_length" id="dataTables-example_length">
                        <label>Mostrar
                            <select name="" id="" v-model="resource_url">
                                <option value="/certificados/paginas/10" >10</option>
                                <option value="/certificados/paginas/25">25</option>
                                <option value="/certificados/paginas/50">50</option>
                                <option value="/certificados/paginas/100">100</option>
                            </select> registros</label></div>
                </div>

                <div class="col-sm-3">
                    <button type="button" class="btn btn-default  " v-on:click="editar()"><i class="fa fa-plus"> Nuevo conductor</i></button>
                </div>
                <div class="col-sm-12">
                    <table class="table  table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid">
                        <thead >
                        <tr>
                            <th class="col">#</th>
                            <th class="column-title">Curso</th>
                            <th scope="col">Conductor</th>
                            <th scope="col">Carnet</th>
                            <th scope="col">Fecha ingreso</th>
                            <th scope="col">Fecha vencimiento</th>
                            <th class="col">Empresa</th>
                            <th class="col">Última modificación</th>
                            <th class="col">Fecha de eliminación</th>
                            <th class="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(certificado,index) in certificados" :key="index">
                            <td>@{{ certificado.id }}</td>
                            <td>@{{ (certificado.curso)?certificado.curso.nombre:'<<<  CURSO ELIMINADO >>>' }}</td>
                            <td>@{{ (certificado.conductor)?certificado.conductor.Nombres+' '+certificado.conductor.Apellidos:'<<<  CONDUCTOR ELIMINADO >>>' }}</td>
                            <td>@{{ certificado.carnet }}</td>
                            <td>@{{ certificado.fecha_ingreso }}</td>
                            <td>@{{ certificado.fecha_vence }}</td>
                            <td>@{{ certificado.empresa_transporte_id }}</td>
                            <td>@{{ certificado.updated_at }}</td>
                            <td>@{{ certificado.deleted_at }}</td>
                            <td>
                                <button type="button" class="btn btn-default btn-circle " v-on:click="editar(certificado.id,index)"><i class="fa fa-pencil"></i></button>
                                <button type="button" class="btn btn-default btn-circle  "v-if="(!certificado.deleted_at)" v-on:click="eliminar(certificado.id)"><i class="fa fa-trash"></i></button>
                                <button type="button" class="btn btn-default btn-circle " v-else v-on:click="restaurar(certificado.id,index)"><i class="fa fa-undo"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <v-paginator :options="options" :resource_url="resource_url" @update="val => certificados = val"></v-paginator>

                </div>
            </div>
        </div>
        @include('registrar.certificados.registrar')
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.2.0/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.5.0/vue-resource.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vuejs-paginator/2.0.0/vuejs-paginator.js"></script>

    <script>
        Vue.use(VueResource)
        //Vue.http.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;

        var vuejs = new Vue({
            el: '#app',
            data: {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                url:"/certificados",
                resource_url: '/certificados/paginas/10',
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
                    curso_id:"",
                    conductor_id:"",
                    carnet:"",
                    fecha_ingreso:"",
                    fecha_vence:"",
                    empresa_transporte_id:"",
                },
                indexEnEdicion:'',
                nuevoRegistro:{
                    estado:1,
                },

                certificados:{},
                lista_cursos:'',
                lista_conductores:'',
                lista_empresas:'',
                errores:{ "message": {}, "errors": {
                        curso_id:"",
                        conductor_id:"",
                        carnet:"",
                        fecha_ingreso:"",
                        fecha_vence:"",
                        empresa_transporte_id:"",
                    } },
            },
            components: {
                VPaginator: VuePaginator
            },
            methods: {
                editar:function (id=null,index=null) {
                    this.indexEnEdicion=index;
                    this.errores={ "message": {}, "errors": {
                            curso_id:"",
                            conductor_id:"",
                            carnet:"",
                            fecha_ingreso:"",
                            fecha_vence:"",
                            empresa_transporte_id:"",
                        } };
                    if(id==null){
                        this.indexEnEdicion='';
                        this.nuevoRegistro.estado=1;
                        this.registroEnEdicion={
                            curso_id:"",
                            conductor_id:"",
                            carnet:"",
                            fecha_ingreso:"",
                            fecha_vence:"",
                            empresa_transporte_id:"",
                        };
                    }else{
                        this.indexEnEdicion=index;
                        this.nuevoRegistro.estado=0;
                        this.$http.get(this.url+'/'+id).then(response=>{
                            this.registroEnEdicion=response.body;
                        }).then(error=>{
                            console.log(error);
                        });                    }
                    $('#certificado').modal('show');
                },
                guardar:function () {
                    console.log(this.csrf);
                    if(this.nuevoRegistro.estado==0){
                        this.$http.put(this.url+'/'+this.registroEnEdicion.id, {
                            _token: this.csrf,
                            empresa: this.registroEnEdicion.empresa_transporte_id,
                            curso: this.registroEnEdicion.curso_id,
                            conductor: this.registroEnEdicion.conductor_id,
                            carnet: this.registroEnEdicion.carnet,
                            inicio: this.registroEnEdicion.fecha_ingreso,
                            vence: this.registroEnEdicion.fecha_vence,
                        }).then(response=>{
                            console.log(this.indexEnEdicion);
                            this.certificados[this.indexEnEdicion]=response.body;
                            //console.log(this.certificados[this.indexEnEdicion]);
                            this.certificados.push();
                            console.log(this.certificados);

                        $('#certificado').modal('hide');
                        }).catch(error=>{
                            this.errores.errors=error.data.errors;
                    });
                    }else{
                        this.$http.post(this.url,{
                                _token: this.csrf,
                                empresa: this.registroEnEdicion.empresa_transporte_id,
                                curso: this.registroEnEdicion.curso_id,
                                conductor: this.registroEnEdicion.conductor_id,
                                carnet: this.registroEnEdicion.carnet,
                                inicio: this.registroEnEdicion.fecha_ingreso,
                                vence: this.registroEnEdicion.fecha_vence,
                            }
                        ).then(response=>{
                            this.certificados.push(response.body);
                            console.log("creado correctamente");
                            $('#certificado').modal('hide');
                        }).catch(error=>{
                            this.errores.errors=error.data.errors;
                        });
                    }
                },

                getListas:function(){
                    this.$http.get(this.url+'/listas/obtener').then(response=>{
                        this.lista_cursos=response.body.cursos;
                        this.lista_conductores=response.body.conductores;
                        this.lista_empresas=response.body.empresas;
                    }).then(error=>{
                        console.log(error);
                    });
                },

                eliminar:function (id) {
                        this.$http.delete(this.url+'/'+id, {
                        params: {
                            _token: this.csrf,
                        }
                    }).then(response=>{
                        console.log('Registro id '+response.body+' eliminado correctamente');
                        $('#certificado').modal('hide');
                    }).catch(error=>{
                        this.errores=error.data;
                    });
                },

                restaurar:function (id,index) {
                    this.indexEnEdicion=index;
                    this.$http.post(this.url+'/restore/'+id, {
                            _token: this.csrf,
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
            mounted(){
                this.getListas();
            }

        });
    </script>
@endsection