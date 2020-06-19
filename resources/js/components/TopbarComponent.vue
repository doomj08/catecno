<template>
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->


        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <label for="">BIENVENIDO</label>



            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->


        </ul>

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
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
