@extends('template.index')

@section('contenido')
@include('sweetalert::alert')
<form action="{{ route('guardarcambiosuser') }}" method="post" enctype='multipart/form-data'>
    @csrf
    <div class="row">
        <div class="col-sm align-middle">
            <div class="card">
                <div class="card-header text-white" style="background-color: #253237;">NUEVO USUARIO</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                                <label for="id">
                                    <h5>Nº Usuario:</h5>
                                </label>
                                <br>
                                <input type="numeric" class="form-control" name="id"  value="{{$consulta->id}}" readonly='readonly'>
                                <label for="name">
                                    <h5>Nombre:</h5>
                                        @if ($errors->first('name'))
                                            <p class="text-danger"> {{$errors->first('name')}}</p>
                                        @endif
                                </label>
                                <br>
                                <input type="text" class="form-control" name="name"  value="{{$consulta->name}}" placeholder="Escriba el Nombre">
                            <br>
                                <label for="text"><h5>Apellidos:</h5>
                                @if ($errors->first('apellidos'))
                                    <p class="text-danger"> {{$errors->first('apellidos')}}</p>
                                @endif
                                </label>
                                <br>
                                <input type="text" class="form-control" name="apellidos"  value="{{$consulta->apellidos}}" placeholder="Escriba los Apellidos">
                            <br>
                                <label for="nacimiento"><h5>Fecha de nacimiento:</h5></label>
                                <br>
                                <input type="date" class="form-control" value="{{$consulta->nacimiento}}" name="nacimiento"/>
                            <br>
                        </div>
                        <div class="col">
                                <label for="dni"><h5>DNI:</h5>
                                @if ($errors->first('dni'))
                                <p class="text-danger"> {{$errors->first('dni')}}</p>
                                @endif
                                </label>
                                <br>
                                <input type="text" class="form-control" value="{{$consulta->dni}}" name="dni" placeholder="Escriba el DNI">
                                <br>
                                <label for="mail"><h5>Correo:</h5>
                                @if ($errors->first('correo'))
                                <p class="text-danger"> {{$errors->first('correo')}}</p>
                                @endif
                                </label>
                                <br>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control"  value="{{$consulta->email}}" id="email" name="email" placeholder="Escribe el correo">
                                </div>
                                <label for="dni"><h5>Contraseña:</h5>
                                @if ($errors->first('password'))
                                <p class="text-danger"> {{$errors->first('password')}}</p>
                                @endif
                                </label>
                                <br>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" value="" id="password" name="password" placeholder="Escriba una Contraseña">
                                </div>
                                <br>
                                <div class="mb-3">
                                    <input class="form-control" type="file" value="{{$consulta->foto}}" name="foto" id="foto">
                                </div>
                                <label for="foto"><h5>Foto:</h5>
                                </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <img src="{{$consulta->url_foto}}" height="70;">&nbsp;&nbsp;<a href="{{ url($consulta->url_foto) }}" download>{{$consulta->foto}}</a>
                                <br>
                                <br>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Guardar</button>
                        </div>
                        </div>
                        <div class="card-footer text-white text-muted" style="background-color: #253237;">Total de tickets: 0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</form>
@stop