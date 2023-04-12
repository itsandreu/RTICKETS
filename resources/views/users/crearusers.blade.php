@extends('template.index')

@section('contenido')
<form action="{{route('guardaruser')}}" method="post" enctype='multipart/form-data'>
    @csrf
    <div class="row">
        <div class="col-sm align-middle">
            <div class="card">
                <div class="card-header text-white" style="background-color: #253237;">NUEVO USUARIO</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                                <label for="username">
                                    <h5>Nombre de Usuario:</h5>
                                </label>
                                <br>
                                <input type="text" class="form-control" name="username"  value="" placeholder="Escriba el Nombre de usuario ">
                            <br>
                                <label for="name">
                                    <h5>Nombre:</h5>
                                        @if ($errors->first('name'))
                                            <p class="text-danger"> {{$errors->first('name')}}</p>
                                        @endif
                                </label>
                                <br>
                                <input type="text" class="form-control" name="name"  value="" placeholder="Escriba el Nombre">
                            <br>
                                <label for="text"><h5>Apellidos:</h5>
                                @if ($errors->first('apellidos'))
                                    <p class="text-danger"> {{$errors->first('apellidos')}}</p>
                                @endif
                                </label>
                                <br>
                                <input type="text" class="form-control" name="apellidos"  value="" placeholder="Escriba los Apellidos">
                            <br>
                                <label for="nacimiento"><h5>Fecha de nacimiento:</h5></label>
                                <br>
                                <input type="date" class="form-control"  name="nacimiento"/>
                            <br>
                        </div>
                        <div class="col">
                                <label for="dni"><h5>DNI:</h5>
                                @if ($errors->first('dni'))
                                <p class="text-danger"> {{$errors->first('dni')}}</p>
                                @endif
                                </label>
                                <br>
                                <input type="text" class="form-control" name="dni" value="" placeholder="Escriba el DNI">
                                <br>
                                <label for="email"><h5>Correo:</h5>
                                @if ($errors->first('correo'))
                                <p class="text-danger"> {{$errors->first('correo')}}</p>
                                @endif
                                </label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Escribe el correo">
                                </div>
                                <br>
                                <label for="password"><h5>Contraseña:</h5>
                                @if ($errors->first('password'))
                                <p class="text-danger"> {{$errors->first('password')}}</p>
                                @endif
                                </label>
                                <br>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Escriba una Contraseña">
                                </div>
                                <label for="password_confirmation"><h5>Confirmar Contraseña:</h5>
                                @if ($errors->first('password'))
                                <p class="text-danger"> {{$errors->first('password')}}</p>
                                @endif
                                </label>
                                <br>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Escriba una Contraseña">
                                </div>
                                <br>
                                <label for="foto"><h5>Foto:</h5>
                                </label>
                                <br>
                                <div class="mb-3">
                                    <input class="form-control" type="file" name="foto" id="foto">
                                <div>
                        </div>
                    </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Crear</button>
                    </div>
                </div>
                    <div class="card-footer text-white text-muted" style="background-color: #253237;">Total de tickets: 0</div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</form>
@stop