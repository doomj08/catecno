<div class="modal fade" id="empresa">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>Cerrar</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">

                    <div class="col-10" v-bind:class="[(errores.errors.razon_social)?'has-error':'' ]">
                        <label for="exampleFormControlSelect1">Nombre del curso</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" v-model="registroEnEdicion.Razon_social" placeholder="Nombre del curso">
                        <span class="control-label" role="alert" v-show="(errores.errors.razon_social)">
                                        <strong>@{{ errores.errors.razon_social }}</strong>
                                </span>
                    </div>

                </div>
            </div>
            <div class="modal-footer">

                <button v-on:click="guardar()">Guardar</button>
            </div>

        </div>
    </div>

</div>