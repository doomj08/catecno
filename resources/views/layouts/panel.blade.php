
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-name" content="{{ Auth()->user()['name'] }}">
    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="app">
<div id="wrapper">
    <sidebar-component
            :menu="[
                    {name: 'CURSOS', link: 'cursos',icono:' fa-graduation-cap'},
                    {name: 'CONDUCTORES', link: 'conductores',icono:'fa-id-badge'},
                    {name: ' EMPRESAS DE TRANSPORTE', link: 'empresas',icono:'fa-industry'},
                    {name: 'CERTIFICADOS', link: 'certificados',icono:'fa-file-alt'},
                    ]"
    ></sidebar-component>
    <div id="content-wrapper" class="d-flex flex-column">
        <topbar-component></topbar-component>
        <div id="content">
                @yield('content')
        </div>
        <footer-component
            titulo="Desarrollado por Itcmn, 2020"
        ></footer-component>
    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->

</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
