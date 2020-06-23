<template>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fas fa-wind"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Itcomn <sup>2</sup></div>
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="/">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Panel de control</span>
                <hr class="sidebar-divider my-0">
            </a>
        </li>

        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Opciones
        </div>

        <li class="nav-item active" v-for="opcion in menu">
            <a class="nav-link" :href="opcion.link">
                <i :class="'fas fa-fw '+opcion.icono"></i>

                <span>{{opcion.name}}</span></a>
        </li>

        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
</template>

<script>
    export default {
        props:{
            menu: {
                type: Array,
                default: [
                    {name: 'INICIO', link: '/', icono:''},
                ]
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
