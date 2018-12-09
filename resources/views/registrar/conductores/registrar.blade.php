<div class="modal fade" id="conductor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>Cerrar</span>
                </button>
            </div>

            <div class="modal-body">
                    <div class="form-row">
                        <div class=" col-10" v-bind:class="[(errores.errors.cedula)?'has-error':'' ]">
                            <label for="cedula">Documento de identidad</label>
                            <input type="text" class="form-control" name="cedula" id="cedula " v-model="registroEnEdicion.cedula" placeholder="Documento de identidad">
                                <span class="control-label" role="alert" v-show="(errores.errors.cedula)">
                                        <strong>@{{ errores.errors.cedula }}</strong>
                                </span>
                        </div>
                        <div class="col-10" v-bind:class="[(errores.errors.nombres)?'has-error':'' ]">
                            <label for="exampleFormControlSelect1">Nombres</label>
                            <input type="text" class="form-control" name="nombres" id="nombres" v-model="registroEnEdicion.Nombres" placeholder="Nombres">
                            <span class="control-label" role="alert" v-show="(errores.errors.nombres)">
                                        <strong>@{{ errores.errors.nombres }}</strong>
                                </span>
                        </div>
                        <div class=" col-10" v-bind:class="[(errores.errors.apellidos)?'has-error':'' ]">
                            <label for="exampleFormControlSelect1">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" v-model="registroEnEdicion.Apellidos" placeholder="Nombres">
                            <span class="control-label" role="alert" v-show="(errores.errors.apellidos)">
                                        <strong>@{{ errores.errors.apellidos }}</strong>
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