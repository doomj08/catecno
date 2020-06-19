<template>
    <div class="flex-center position-ref full-height">


        <div class="content">
            <div class="title m-b-md">
                <button>
                <a href="panel">Ir al panel</a>
                </button>
            </div>

            <div class="card">
                <div class="card-heading">
                    <h3> Panel CRUD</h3>
                    <h4>CRUD (Crear, Leer, Actualizar, Eliminar)</h4>
                </div>
                <div class="card-footer">
                    <p>Acá podrá editar, eliminar, y agregar información.</p>
                    <p>La información eliminada por medio de este panel, no es eliminada permanentemente.</p>
                </div>
            </div>

            <div class="links">

            </div>
        </div>
    </div>
</template>
<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>
<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
