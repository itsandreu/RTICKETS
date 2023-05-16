@extends('template.index')

@section('contenido')
<form action="{{route('guardarticket')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm align-middle">
            <div class="card">
                <div class="card-header text-white" style="background-color: #253237;">NUEVO TICKET</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                    <label for="id_user"><h5>Creado Por:</h5>
                                    @if ($errors->first('id_user'))
                                    <p class="text-danger"> {{$errors->first('id_user')}}</p>
                                    @endif
                                    </label>
                                    <br>
                                    <select class="form-control" id="id_user" value="" name="id_user" style="background-color:#fefae0;">
                                        <option value="{{Auth::user()->id}}"> {{Auth::user()->name}} {{Auth::user()->apellidos}}</option>
                                    </select>
                                <br>
                                    <label for="id_prioridad"><h5>Prioridad:</h5></label>
                                    <br>
                                    <select class="form-control" id="id_prioridad" value="{{ old('prioridad') }}" name="id_prioridad" style="background-color:#fefae0;">
                                    
                                    @foreach($prioridades as $prio)
                                    @if ($prioridades[0]->id == $prio->id)
                                    <option selected value="{{$prioridades[0]->id}}">{{$prioridades[0]->name}}</option>
                                    @else
                                    <option value="{{ $prio->id }}">{{ $prio->name }}</option>
                                    @endif
                                    @endforeach
                                    </select>
                                <br>
                                    <label for="id_estado"><h5>Estado:</h5></label>
                                    <br>
                                    <select class="form-control" id="id_estado" name="id_estado" value="" style="background-color:#fefae0;">
                                        @foreach($estados as $est)
                                        @if ($estados[0]->id == $est->id )
                                        <option selected value="{{$estados[0]->id}}">{{$estados[0]->name}}</option>
                                        @else
                                        <option value="{{ $est->id }}">{{ $est->name }}</option>  
                                        @endif 
                                        @endforeach
                                    </select>
                                <br>
                                    <label for="adjuntos" class="form-label"><h5>Adjuntos: (Imagenes y archivos)</h5></label>
                                        @if ($errors->first('adjuntos'))
                                        <p class="text-danger"> {{$errors->first('adjuntos')}}</p>
                                        @endif
                                    </label>
                                    <input class="form-control" type="file" id="adjuntos" name="adjuntos[]" multiple>
                            </div>
                            <div class="col">
                                    <label for="asignado"><h5>Asignado a:</h5>
                                    @if ($errors->first('id_user'))
                                    <p class="text-danger"> {{$errors->first('id_user')}}</p>
                                    @endif
                                    </label>
                                    <br>
                                    <select class="form-control" id="asignado" value="" name="asignado" style="background-color:#fefae0;">
                                        @foreach($users as $u)
                                        <option value="{{ $u->id }}">{{ $u->name }} {{$u->apellidos}}</option>
                                        @endforeach
                                    </select>
                                <br>
                                    @if ($errors->first('titulo'))
                                    <p class="text-danger"> {{$errors->first('titulo')}}</p>
                                    @endif
                                    <label for="text"><h5>Titulo:</h5></label>
                                    <br>
                                    <input type="text" class="form-control" name="titulo"  value="{{ old('titulo') }}" placeholder="Escriba el título" style="background-color:#fefae0;">
                                <br>
                                    <label for="descripcion"><h5>Descripción:</h5></label>
                                    @if ($errors->first('descripcion'))
                                        <p class="text-danger"> {{$errors->first('descripcion')}}</p>
                                    @endif
                                    <textarea class="form-control" id="descripcion" name="descripcion" value="{{ old('descripcion') }}" rows="5" style="background-color:#fefae0;"></textarea>
                                <br>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 ms-2 me-2">Crear</button>
                    <div class="card-footer text-white text-muted" style="background-color: #253237;">Total de tickets: 0 </div>
                </div>
            </div>
        </div>
    </div>
</form>
@stop