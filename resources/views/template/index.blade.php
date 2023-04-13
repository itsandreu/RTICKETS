<?php
$url_base = "/RTICKETS/public/"
?>
<!doctype html>
<html lang="es">

<head>
    <title>Gestor de Tickets</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- DataTables-->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="/Applications/XAMPP/xamppfiles/htdocs/proyecto/resources/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.2.3/dist/lumen/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    nav,
    .offcanvas {
        background-color: #1e293b;
    }
    .navbar-toggler {
        border: none;
        color: #f79256;
    }
    .navbar-toggler:focus {
        outline: none;
        box-shadow: none;
        color: #f79256;
    }
    .nav-link:hover{
        color: #f79256 !important;
    }
    .badge:hover{
        color: #f79256 !important;
    }
    .fs-4:hover{
        color: #f79256 !important;
    }
    .navlink:focus {
        outline: none;
        box-shadow: none;
        color: #f79256;
    }

    /* Ocultar campo de contraseña */
    .hidetext { -webkit-text-security: disc; /* Default */ }

    @media(max-width:990px) {
        .navlink:focus>li:hover {
            background-color: #cfdbd5;
        }
    }
    @media(max-width:768px) {
        .navbar-nav>li:hover {
            background-color: #cfdbd5;
        }
    }
    .highlight {
        background-color: yellow;
        font-weight: bold;
    }
</style>
<body style="background-color: #edede9;">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <img src="{{asset('assets/ERRE.png')}}" width="50" height="40" class="d-inline-block align-top" alt="Inicio">
                    <span class="fs-4 float-end">Tickets ©</span>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#menuLateral"><span class="navbar-toggler-icon"></span></button>
                <section class="offcanvas offcanvas-start" id="menuLateral" tabindex="-1">
                    <div class="offcanvas-header" data-bs-theme="dark">
                        <h5 class="offcanvas-title text-info">
                            <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                                <img src="{{asset('assets/ERRE.png')}}" width="50" height="40" class="d-inline-block align-top" alt="Inicio">
                                <span class="fs-4 float-end">Tickets ©</span>
                            </a>
                        </h5>
                        <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offcanvas-body d-flex flex-column justify-content-between px-0">
                        <ul class="navbar-nav fs-7 justify-content-evenly">
                            <li class="nav-item p-3 py-md-0"><a href="{{ route('dashboard') }}" class="nav-link text-white"><b>Dashboard</b></a></li>
                            <li class="nav-item p-3 py-md-0"><a href="{{ route('tickets') }}" class="nav-link text-white"><b>Tickets</b></a></li>
                            <li class="nav-item p-3 py-md-0"><a href="#" class="nav-link text-white"><b>Mis Tickets</b></a></li>
                            <li class="nav-item p-3 py-md-0"><a href="{{ route('users') }}" class="nav-link text-white"><b>Usuarios</b></a></li>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{asset('assets/ERRE.png')}}" alt="" width="20" height="20">
                                    {{ Auth::user()->name }}&nbsp;{{ Auth::user()->apellidos }}
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                                    <li><a class="dropdown-item" href="#">Mis Tickets</a></li>
                                    <li><a class="dropdown-item post-link" data-action="{{ route('signout') }}" href="#">Cerrar Sesion</a></li>
                                </ul>
                            </div>
                        </ul>
                    </div>
                    <div class="d-lg-none">
                        <h3 style="text-align:center; color:#f4f1de;">© Gestor de Tickets 2023 ©</h3>
                        <h5 style="text-align:center; color:#f4f1de;">By Ricardo Andreu Gimeno</h5>
                    </div>
                    <div class="d-lg-none align-self-center py-3">
                        <a href=""><i class="bi bi-twitter px-2 text-indo fs-2"></i></a>
                        <a href=""><i class="bi bi-facebook px-2 text-indo fs-2"></i></a>
                        <a href=""><i class="bi bi-github px-2 text-indo fs-2"></i></a>
                    </div>
                </section>
            </div>
        </nav>
        <div class="container-fluid mt-3 ml-3 mr-3">
            @yield('contenido')
        </div>
        <footer>
            <div class="container-fluid float-bottom" style=" text-align:center; width: 280px; height: 100px;">
                <br>
                <h5 style="color: black;">© Gestor de Tickets 2023 ©</h5>
                <h7>Creado por Ricardo Andreu Gimeno</h7>
            </div>
        </footer>
</body>
<!-- Bootstrap JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tickets').DataTable({
            "lengthMenu": [
                [5, 10, 50, -1],
                [5, 10, 50, "All"]
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
    });
</script>
<script>
$('.datepicker').datepicker()
</script>
<script>
    $(document).ready(function() {
        $('.post-link').click(function(event) {
        event.preventDefault();

        var action = $(this).data('action');
        var token = '{{ csrf_token() }}';

        var form = $('<form>', {
        'action': action,
        'method': 'POST',
        'style': 'display:none;'
        });

        var input = $('<input>', {
        'type': 'hidden',
        'name': '_token',
        'value': token
        });

        form.append(input);
        form.appendTo('body').submit();
    });
    });
</script>

</html>