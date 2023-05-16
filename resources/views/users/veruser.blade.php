@extends('template.index')
@section('contenido')
@include('sweetalert::alert')
<div class="card shadow mb-4">
    <div class="card-header py-3 text-center" style="background-color: #477998;" >
        <h4 class=" justify-content-start ms-0 font-weight-bold text-dark-emphasis" style="color:aliceblue;"><b>{{$consulta->name}} {{$consulta->apellidos}}</b></h6>
    </div>
    <div class="card-body">
    <div class="row d-flex">
        <div class="col-3" style="min-width: 350px;">
            <img src="{{$consulta->url_foto}}" alt="" height="200px;">
        </div>
        <div class="col float-end">
            <h4><b>{{$consulta->name}} {{$consulta->apellidos}}</b></h4>
            <hr>
            <h6><b>Fecha de Nacimiento:</b> {{$consulta->nacimiento}}</h6>
            <br>
            <h6><b>Correo:</b> {{$consulta->email}}</h6>
            <br>
            <h6><b>Miembro desde: </b> {{$consulta->created_at}}</h6>
            <br>
            <a href="{{ route('misticketscreados',['id'=>Auth::user()->id])}}">
                <button type="button" class="btn btn-primary">
                    Total Tickets Asignados : <span class="badge bg-secondary">{{$asignados}}</span>
                </button>
            </a>
            <br>
            <br>
            <button type="button" class="btn btn-primary">
                Total Tickets creados : <span class="badge bg-secondary">{{$creados}}</span>
            </button>
            <br>
            <br>
            <a name="" id="" class="btn btn-warning" href="{{ route('editarusers',['id'=>$consulta->id]) }}" role="button">Editar Usuario</a>
        </div>
    </div>
    </div>
</div>
@stop