@extends('template.index')
@section('contenido')
@include('sweetalert::alert')
<div class="card shadow mb-4">
    <div class="card-header py-3 text-center" style="background-color: #477998;" >
        <h4 class=" justify-content-start ms-0 font-weight-bold text-dark-emphasis" style="color:aliceblue;"><b>USUARIOS</b></h6>
        <div class="float-start m-0">
            <a href="{{route('register.verify')}}">
                <button type="button" class="btn btn-success"><b>Nuevo Usuario</b></button>
            </a>
        </div>
        <div class="float-end">
            <a href="{{route('disabledusers')}}">
                <button type="button" class="btn btn-warning"><b>Usuarios Deshabilitados</b></button>
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-13">
                        <table id="tickets" class="table table-striped shadow-lg mt-4" style="width:100%">
                            <thead class="bg-dark text-black" style="text-align: center;">
                                <tr style="background-color: #89c2d9;">
                                    <th scope="col" style="text-align: center;">ID Empleado</th>
                                    <th scope="col" style="text-align: center;">Foto</th>
                                    <th scope="col" style="text-align: center;">Nombre</th>
                                    <th scope="col" style="text-align: center;">Fecha de Nacimiento</th>
                                    <th scope="col" style="text-align: center;">DNI</th>
                                    <th scope="col" style="text-align: center;">Correo</th>
                                    <th scope="col" style="text-align: center;">Contraseña</th>
                                    <th scope="col" style="text-align: center;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($consulta as $user)
                                <tr style="text-align: center; background-color:#e2eafc;">
                                    <td>{{$user->id}}</td>
                                    <td><img src="{{$user->url_foto}}" height="50;"></td>
                                    <td>{{$user->name}} {{$user->apellidos}}</td>
                                    <td>{{$user->nacimiento}}</td>  
                                    <td>{{$user->dni}}</td>
                                    <td>{{$user->email}}</td>
                                    <td class="hidetext">{{$user->password}}</td>
                                    <td>
                                        <div class="btn-group ">
                                                <a href="{{ route('editarusers',['id'=>$user->id]) }}">
                                                    <button type="button" class="btn btn-outline-dark">
                                                        <i class="bi bi-brush"></i>
                                                    </button>
                                                </a>
                                            &nbsp;
                                                <a class="btn btn-outline-dark" onclick="confirmationdiableduser(event)" href="{{ route('deshabilitarusers',['id'=>$user->id]) }}">
                                                    <i class="bi bi-eye-slash"></i>
                                                </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop