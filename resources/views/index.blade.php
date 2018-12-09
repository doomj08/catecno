@extends('layouts.app_panel')
@section('content')


<div class="row">
    <h1 class="page-header">
        Bienvenido
    </h1>
<div class="col-lg-12">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-collapse collapse in">
                <div class="panel-heading">
                    <h3> Panel CRUD</h3>
                    <h4>CRUD (Crear, Leer, Actualizar, Eliminar)</h4>
                </div>
                <div class="panel-body">
                    <p>Acá podrá editar, eliminar, y agregar información.</p>
                    <p>La información eliminada por medio de este panel, no es eliminada permanentemente.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-collapse collapse in">
                <div class="panel-heading">
                    <h3> Acerca de:</h3>
                    <h4></h4>
                </div>
                <div class="panel-body">
                    <p>Este panel fué desarrollado por Jorge Luis Tinjacá en representación de ITCOMN para PERFECT SAS.</p>
                    <p>Cualquier inquietud, por favor comuníquese via telefono o whatsapp con su administrador.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-collapse collapse in">
                <div class="panel-heading">
                    <h3> Javier Ruggery:</h3>
                    <h4>Administrador</h4>
                </div>
                <div class="panel-body">
                    <p>   Teléfono: 318 6943892
                        <button class="btn-info" onclick="location.href='tel:3186943892'" type="button">Llamar</button>
                        <button class="btn-success" onclick="location.href=' https://wa.me/573186943892'" type="button">Whatsapp</button>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-collapse collapse in">
                <div class="panel-heading">
                    <h3> Jorge Luis Tinjacá:</h3>
                    <h4>Programador</h4>
                </div>
                <div class="panel-body">
                    <p>   Teléfono: 310 6135098
                        <button class="btn-info" onclick="location.href='tel:3106135098'" type="button">Llamar</button>
                        <button class="btn-success" onclick="location.href=' https://wa.me/573106135098'" type="button">Whatsapp</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>





@endsection()






