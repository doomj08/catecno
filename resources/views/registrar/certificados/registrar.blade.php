<div class="modal fade" id="certificado">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>Cerrar</span>
                </button>
            </div>

            <div class="modal-body">
                    <div class="form-row">
                        <div class=" col-10" v-bind:class="[(errores.errors.empresa)?'has-error':'' ]">
                            <label for="curso_id">Empresa transportadora</label>
                            <select type="text" class="form-control" name="curso_id" id="curso_id " v-model="registroEnEdicion.empresa_transporte_id">
                                <option value="">Seleccione...</option>
                                <option v-for="empresa in lista_empresas" :value="empresa.id">@{{ empresa.Razon_social }}</option>
                            </select>
                                <span class="control-label" role="alert" v-show="(errores.errors.empresa)">
                                        <strong>@{{ errores.errors.empresa }}</strong>
                                </span>
                        </div>

                        <div class=" col-10" v-bind:class="[(errores.errors.curso)?'has-error':'' ]">
                            <label for="curso_id">Nombre del curso</label>
                            <select type="text" class="form-control" name="curso_id" id="curso_id " v-model="registroEnEdicion.curso_id">
                                <option value="">Seleccione...</option>
                                <option v-for="curso in lista_cursos" :value="curso.id">@{{ curso.nombre }}</option>
                            </select>
                            <span class="control-label" role="alert" v-show="(errores.errors.curso)">
                                        <strong>@{{ errores.errors.curso }}</strong>
                                </span>
                        </div>

                        <div class="col-10" v-bind:class="[(errores.errors.conductor)?'has-error':'' ]">
                            <label for="conductor_id">Conductor</label>
                            <select type="text" class="form-control" name="conductor_id" id="conductor_id " v-model="registroEnEdicion.conductor_id">
                                <option value="">Seleccione...</option>
                                <option v-for="conductor in lista_conductores" :value="conductor.id">@{{conductor.cedula}} ::: @{{conductor.Nombres}} @{{conductor.Apellidos}}</option>
                            </select>
                            <span class="control-label" role="alert" v-show="(errores.errors.conductor)">
                                        <strong>@{{ errores.errors.conductor }}</strong>
                                </span>
                        </div>
                        <div class=" col-10" v-bind:class="[(errores.errors.carnet)?'has-error':'' ]">
                            <label for="carnet">Código del carnet</label>
                            <input type="text" class="form-control" name="carnet" id="carnet" v-model="registroEnEdicion.carnet" placeholder="Código del carnet">
                            <span class="control-label" role="alert" v-show="(errores.errors.carnet)">
                                        <strong>@{{ errores.errors.carnet }}</strong>
                                </span>
                        </div>
                        <div class=" col-6" v-bind:class="[(errores.errors.inicio)?'has-error':'' ]">
                            <label for="inicio">Fecha de inicio</label>
                            <input type="date" class="form-control" name="inicio" id="inicio" v-model="registroEnEdicion.fecha_ingreso">
                            <span class="control-label" role="alert" v-show="(errores.errors.inicio)">
                                        <strong>@{{ errores.errors.inicio }}</strong>
                                </span>
                        </div>
                        <div class=" col-6" v-bind:class="[(errores.errors.vence)?'has-error':'' ]">
                            <label for="inicio">Fecha de vigencia</label>
                            <input type="date" class="form-control" name="vence" id="vence" v-model="registroEnEdicion.fecha_vence">
                            <span class="control-label" role="alert" v-show="(errores.errors.vence)">
                                        <strong>@{{ errores.errors.vence }}</strong>
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