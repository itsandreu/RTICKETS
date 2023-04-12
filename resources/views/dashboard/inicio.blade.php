@extends('template.index')

@section('contenido')

<!-- Mensaje de crear ticket -->
@if (session()->has('mensaje'))
<div class="alert alert-success pb-1 ms-5 me-5"  role="alert">
    <h5 style="text-align: center;">{{ Session('mensaje') }}</h3>
</div>
@endif
@if (session('bienvenido'))
<div class="alert alert-success pb-1 ms-5 me-5"  role="alert">
    <h5 style="text-align: center;">{{ Session('bienvenido') }}<br>{{ Auth::user()->name }}</h3>
</div>
@endif
<div class="row m-3 p-3">
    <div class=" col-sm m-3 rounded-end rounded-start border-light shadow">
        <div class="card text-black shadow mt-3 mb-3" style="max-width: 50rem; background-color:#ffee32"">
            <div class=" card-header" style="text-align: center;">
            <b>TICKETS</b>
            </div>
        <div class="card-body">
            <h1 class="card-title" style="text-align: center; color:black">{{$ticketscount}}</h1>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <a href="{{ route('crearticket')}}">
                <button type="button" class="btn btn-success"><b>Crear Nuevo Ticket</b></button>
            </a>
        </div>
        </div>
    </div>
    <div class="col-sm m-3 rounded-end rounded-start border-light shadow">
        <div class="card text-black shadow mt-3 mb-3" style="max-width: 50rem; background-color:#52b788">
            <div class="card-header" style="text-align: center;">
            <b>ABIERTOS</b>
            </div>
            <div class="card-body">
                <h1 class="card-title" style="text-align: center; color:black">{{$ticketsabiertos}}</h1>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <a href="#">
                    <button  type="button" class="btn btn-primary">Ver</button>
                </a>
            </div>
        </div>
    </div>
    <div class="col-sm m-3 rounded-end rounded-start border-light shadow">
        <div class="card text-black shadow mt-3 mb-3" style="max-width: 50rem; background-color:#b5e2fa">
            <div class="card-header" style="text-align: center;">
            <b>EN PROCESO</b>
            </div>
            <div class="card-body">
                <h1 class="card-title" style="text-align: center; color:black">{{$ticketsenproceso}}</h1>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <a href="#">
                    <button class="btn btn-primary" type="button">Ver</button>
                </a>
            </div>
        </div>
    </div>
    <div class="col-sm m-3 rounded-end rounded-start border-light shadow">
        <div class="card text-black shadow mt-3 mb-3" style="max-width: 50rem; background-color:#ff99ac">
            <div class="card-header" style="text-align: center;">
            <b>CERRADOS</b>
            </div>
            <div class="card-body">
                <h1 class="card-title" style="text-align: center; color:black">{{$ticketscerrados}}</h1>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <a href="#">
                    <button class="btn btn-primary" type="button">Ver</button>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row m-3 p-3">
    <div class=" col-sm m-3 rounded-end rounded-start border-light shadow align-items-center">
        <div class="card text-black shadow mt-3 mb-3" style="max-width: 45rem; background-color:#83c5be"">
            <div class=" card-header" style="text-align: center;">
            <b>USUARIOS</b>
            </div>
        <div class="card-body">
            <h1 class="card-title" style="text-align: center; color:black">{{ $usersCount }}</h1>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <a href="{{ route('register')}}">
                <button type="button" class="btn btn-secondary"><b>Crear Nuevo Usuario</b></button>
            </a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="{{ route('users') }}">
                <button type="button" class="btn btn-secondary"><b>Ver</b></button>
            </a>
        </div>
        </div>
    </div>
    <div class=" col-sm m-3 rounded-end rounded-start border-light shadow">
        <div class="card text-black shadow mt-3 mb-3" style="max-width: 45rem; background-color:#f6cb52"">
            <div class=" card-header" style="text-align: center;">
            <b>USUARIOS DESACTIVADOS</b>
            </div>
        <div class="card-body">
            <h1 class="card-title" style="text-align: center; color:black">{{ $usersDisabled }}</h1>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <a href="#">
                <button type="button" class="btn btn-secondary"><b>Ver</b></button>
            </a>
        </div>
        </div>
    </div>
</div>
@stop