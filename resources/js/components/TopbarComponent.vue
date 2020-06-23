<template>
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->


        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->

            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{user_name}}</span>
                </a>
            </li>
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cerrar Sesión
                </a>
            </li>
        </ul>
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-primary" v-on:click="cerrarsesion" href="/">Cerrar sesion</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        props:{
            menu: {
                type: Array,
                default: [
                    {name: 'INICIO', link: '/', icono:''},
                ]
            },
            user:{
                type:String,
                default: 'Nombre de usuario'
            }
        },
        data(){
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                user_name: document.querySelector('meta[name="user-name"]').getAttribute('content'),
                url:'logout',
            }
        },
        methods:{
            cerrarsesion(){
                axios.post(
                    this.url,{
                    _token:this.csrf
                    }

                ).then(
                    (res)=>{
                    }).catch(e=>{
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
