<template>
    <div>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-3 row">
                    <div class="row col-sm-6">
                        <h6 class="m-0 font-weight-bold text-primary">{{titulo}}
                            <a href="#" class="btn btn-primary pull-right" data-toggle="modal" :data-target="'#create'+titulo">
                                Nuevo Registro
                            </a>
                        </h6>
                    </div>
                    <div class="row col-sm-6">
                        <div class="col-sm-12 col-md-6">
                            <div class="row-cols-12">
                                <label class="col-md-12">Mostrar
                                    <select @change="consultar(1)" v-model="per_page" name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm col-md-3">
                                        <option :value=1>1</option>
                                        <option :value=10>10</option>
                                        <option :value=25>25</option>
                                        <option :value=50>50</option>
                                        <option :value=100>100</option>
                                    </select> registros
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">


                                <div class="input-group-append col-12">
                                    <input @change="consultar(1)" v-model="search" type="search" aria-controls="dataTable" class="form-control bg-white text-black-50 border-0 small col-8" placeholder="Buscar por...">
                                    <button class="btn btn-primary" type="button" @change="consultar(1)">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>

                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="" class="dataTables_wrapper dt-bootstrap4 ">


                            <div class="row col-sm-12">
                                <div class="col-sm-12">
                                    <spinner-component v-if="cargando"></spinner-component>
                                    <table v-else class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th v-for="columna in columnas" class=" sorting" aria-controls="dataTable" v-if="columna.alias" aria-label="Position: activate to sort column ascending" style="width: 325px;">{{columna.alias}}</th>
                                            <th v-else class="sorting" aria-controls="dataTable">{{columna.nombre}}</th>
                                            <th class="">Acciones</th>
                                        </tr>
                                    </thead>
                            <tfoot>
                                <tr>
                                    <th v-for="columna in columnas" v-if="columna.alias">{{columna.alias}}</th>
                                    <th v-else>{{columna.nombre}}</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <tr v-for="(item,index) in items" >
                                <td v-for="columna in columnas"
                                    :class="(mayus)?'uppercase':''"
                                    v-if="item[columna.nombre]&&columna.subcolumna&&columna.subcolumna2"
                                >
                                    {{item[columna.nombre][columna.subcolumna]}} {{item[columna.nombre][columna.subcolumna2]}}
                                </td>
                                <td  v-else-if="item[columna.nombre]&&columna.subcolumna"
                                     :class="(mayus)?'uppercase':''"
                                >
                                    {{item[columna.nombre][columna.subcolumna]}}
                                </td>
                                <td v-else-if="columna.urlarchivo"
                                    :class="(mayus)?'uppercase':''"
                                >
                                    <a :href="'pdf/'+item[columna.nombre]">
                                        <button type="button" v-if="item[columna.nombre]" class="btn btn-success  btn-sm col-sm-12">
                                            Ver
                                            {{item[columna.nombre]}}
                                        </button>
                                    </a>
                                    <button type="button" class="btn btn-primary  btn-sm col-sm-12"  @click="modalpdf(columna.urlarchivo,item['id'])">
                                        Cargar PDF
                                    </button>
                                </td>
                                <td v-else
                                    :class="(mayus)?'uppercase':''"
                                >
                                    {{item[columna.nombre]}}
                                </td>
                                <td class="inline-block">
                                    <button class="btn btn-primary btn-circle btn-sm " @click="editarcampos(item)"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger btn-circle btn-sm "  @click="eliminar(item.id)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                                </div>
                            </div>
                            <div class="row col-sm-12">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                                        Mostrando {{pagination.from}} a {{pagination.to}} de {{pagination.total}} registros
                                    </div>
                                </div>
                                <nav>
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous" :class="[pagination.current_page<=1?'disabled':'']">
                                            <a href="#" @click.prevent="changePage(pagination.current_page-1)" class="page-link">
                                                <span>Atras</span>
                                            </a>
                                        </li>
                                        <li v-for="page in pagesNumber" :class="[page==isActive?'active':'']" class="page-item">
                                            <a href="#" @click.prevent="changePage(page)" class="page-link">
                                                {{page}}
                                            </a>
                                        </li>
                                        <li class="paginate_button page-item next" :class="[pagination.current_page<pagination.last_page?'':'disabled']">
                                            <a href="#" @click.prevent="changePage(pagination.current_page+1)" class="page-link">
                                                <span>Siguiente</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
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
            <pdf-component
                :url="urlpdf"
                @actualizardatos="consultar()"
            ></pdf-component>
        </div>
    </div>
    <!-- /.container-fluid -->
    </div>

</template>
<style scoped>
    .uppercase{
        text-transform: uppercase;
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
            mayus:{
                type:Boolean,
                default:false
            },
            campos:{
                type:Array,
                default:[{nombre: 'id', tipo: 'Number',value:''},]
            },
            columnas:{
                type:Array,
                default:[{nombre: 'columna'}]
            },
            search:{
                type:String,
                default:''
            },
            per_page:{
                type:Number,
                default:10
            },
        },
        data: function () {
            return {
                items:[{}],
                listas:'',
                errores:[],
                cargando:true,
                camposeditados:[],
                urlpdf:'',
                pagination: {
                    'total': 0,
                    'per_page':0,
                    'current_page':0,
                    'last_page':0,
                    'from':0,
                    'to':0,
                },
                offset:3

            }
        },
        methods:{
            consultar(page){
                if(page){
                    this.pagination.current_page=page;
                }
                this.cargando=true;
                axios.get(this.url+'?page='+this.pagination.current_page+'&filter='+this.search+'&per_page='+this.per_page )
                    .then((res)=>{
                        this.items=res.data.tabla.data
                        this.pagination=res.data.pagination
                        this.listas=res.data.listas
                        this.cargando=false;
                        this.camposeditados="";
                    })
                    .catch(e => {
                        this.errores=e.response.data.errors;
                    });
            },
            modalpdf(url,item){
                this.urlpdf=url+'/'+item;
                $('#subirpdf').modal('show');
            },
            editarcampos(item){
                this.camposeditados=item
                $('#editcomponent').modal('show');
            },
            eliminar(id){
                swal.fire({
                    title: 'Está seguro de que desea eliminar este registro?',
                    text: "Si lo elimina ya no se podrá recuperar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, deseo eliminar',
                    cancelButtonText: 'No, cancelar'
                }).then((result) => {
                    if (result.value) {
                        this.cargando=true;
                        axios.delete(this.url+'/'+id)
                            .then((res)=>{
                                this.cargando=false;
                                swal.fire(
                                    'Borrado!',
                                    'Su registro ha sido eliminado',
                                    'success'
                                )
                                this.consultar();
                            })
                            .catch(e => {
                                this.errores=e.response.data.errors;
                            });


                    }
                })
            },
            changePage(page){
                this.pagination.current_page=page;
                this.consultar();
            }
        },
        computed:{
            isActive(){
                return this.pagination.current_page;
            },
            pagesNumber(){
                if(!this.pagination.to){
                    return [];
                }
                var from=this.pagination.current_page-this.offset;
                if(from<1){
                    from=1;
                }

                var to = from + (this.offset*2);
                if(to>=this.pagination.last_page){
                    to=this.pagination.last_page;
                }

                var pagesArray = [];
                while (from <=to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;

            }
        },
        mounted() {
            this.consultar();
        },
    }
</script>
