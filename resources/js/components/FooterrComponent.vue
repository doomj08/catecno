<template>
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>{{titulo}}</span>
            </div>
        </div>
    </footer>
</template>

<script>
    export default {
        props:{
            titulo:{
                type:String,
                default:'Copyright © Your Website 2019'
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
