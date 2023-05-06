@extends('template.index')

@section('contenido')
@include('sweetalert::alert')
<form action="{{ route('guardarcambiosticket') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm align-middle">
            <div class="card">
                <div class="card-header" style="background-color: #aec3b0;">EDITAR TICKET</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                    <input type="hidden" name="updated_by" value="{{ Auth::user()->id }}">

                                    <label for="id"><h5>Nº Ticket:</h5></label>
                                    <br>
                                    <input type="numeric" class="form-control" name="id"  value="{{$ticket->id}}" readonly='readonly'>
                                <br>
                                    <label for="id_user"><h5>Creado Por:</h5>
                                    @if ($errors->first('id_user'))
                                    <p class="text-danger"> {{$errors->first('id_user')}}</p>
                                    @endif
                                    </label>
                                    <br>
                                    <select class="form-control" id="id_user" value="{{$ticket->id_user}}" name="id_user">
                                        <option selected value="{{$ticket->id_user}}">{{ $ticket->usuario->name }}</option>
                                    </select>
                                <br>
                                    <label for="id_estado"><h5>Estado:</h5></label>
                                    <br>
                                    <select class="form-control" id="id_estado" name="id_estado">
                                        <option selected value="{{$ticket->id_estado}}">{{$ticket->estado->name}}</option>
                                        @foreach ($estados as $est)
                                        <option value="{{$est->id}}">{{$est->name}}</option>
                                        @endforeach
                                    </select>
                                <br>
                                    <label for="id_prioridad"><h5>Prioridad:</h5></label>
                                    <br>
                                    <select class="form-control" id="id_prioridad" name="id_prioridad">
                                        <option value="{{$ticket->id_prioridad}}">{{$ticket->prioridad->name}}</option>
                                        @foreach($prioridades as $prio)
                                        <option value="{{ $prio->id}}">{{$prio->name}}</option>
                                        @endforeach
                                    </select>
                                <br>
                                <label for="adjuntos" class="form-label"><h5>Añadir Adjuntos:</h5></label>
                                        @if ($errors->first('adjuntos'))
                                        <p class="text-danger"> {{$errors->first('adjuntos')}}</p>
                                        @endif
                                    </label>
                                    <input class="form-control" type="file" id="adjuntos" name="adjuntos[]" rows="9" multiple>
                                    <br>
                                    <table id="tickets" class="table table-striped shadow-lg mt-4" style="width:100%">
                                        <thead class="bg-dark text-black" style="text-align: center;">
                                            <tr style="background-color:#b7b7a4;">
                                                <th scope="col" style="text-align: center;">Preview</th>
                                                <th scope="col" style="text-align: center;"><i class="bi bi-chevron-double-right">&nbsp;&nbsp;</i>Archivo</th>
                                                <th scope="col" style="text-align: center;"><i class="bi bi-gear-fill">&nbsp;&nbsp;&nbsp;&nbsp;</i>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($adjuntos as $file)
                                                @if (strpos($file, '.jpg') !== false || strpos($file, '.jpeg') !== false || strpos($file, '.JPG') !== false || strpos($file, '.PNG') !== false || strpos($file, '.png') !== false || strpos($file, '.gif') !== false)
                                                    <tr style="text-align: center; background-color:#edf2f4;">
                                                        <td>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalId-{{$file->id}}" title="{{$file->nombreoriginal}}">
                                                                <img src="{{$file->archivo}}" alt="" width="65">
                                                            </a>
                                                            <div class="modal fade" id="modalId-{{$file->id}}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modalTitleId">{{$file->nombreoriginal}}</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img src="{{$file->archivo}}" alt="" width="1000">
                                                                    </div>
                                                                    <div class="modal-footer mx-auto">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </td>
                                                        <td>{{$file->nombreoriginal}}</td>
                                                        <td class="justify-content-center">
                                                            &nbsp;
                                                            <a class="btn btn-outline-dark" onclick="confirmationdeletefile(event)" href="{{ route('eliminararchivo',['id'=>$file->id]) }}">
                                                                <i class="bi bi-trash3"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @else
                                                    <tr style="text-align: center; background-color:#edf2f4;">
                                                        <td>
                                                            <a href="{{$file->archivo}}" download>
                                                                <img src="/adjuntos/archivo.png" alt="" width="80" title="{{$file->nombreoriginal}}">
                                                            </a>
                                                        </td>
                                                        <td>{{$file->nombreoriginal}}</td>
                                                        <td>
                                                            &nbsp;
                                                            <a href="{{ route('eliminararchivo',['id'=>$file->id]) }}">
                                                                <button type="button" class="btn btn-outline-dark">
                                                                    <i class="bi bi-trash3" onclick="return confirm('¿Quieres Eliminar el Archivo?')"></i>
                                                                </button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                <br>
                            </div>
                            <div class="col">
                            <label for="asignado"><h5>Asignado a:</h5>
                                    @if ($errors->first('id_user'))
                                    <p class="text-danger"> {{$errors->first('id_user')}}</p>
                                    @endif
                                    </label>
                                    <br>
                                    <select class="form-control" id="asignado" value="{{$ticket->asignadoA->name}}" name="asignado">
                                        @foreach($users as $u)
                                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <label for="text"><h5>Titulo:</h5></label>
                                    @if ($errors->first('titulo'))
                                    <p class="text-danger"> {{$errors->first('titulo')}}</p>
                                    @endif
                                    <input type="text" class="form-control" name="titulo"  id="titulo" value="{{$ticket->titulo}}" placeholder="Escriba el título">
                                    <br>
                                    <label for="descripcion"><h5>Descripción:</h5></label>
                                    @if ($errors->first('descripcion'))
                                        <p class="text-danger"> {{$errors->first('descripcion')}}</p>
                                    @endif
                                    <textarea class="form-control" id="descripcion" value="{{$ticket->descripcion}}" name="descripcion" rows="9">{{$ticket->descripcion}}</textarea>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                <div class="card-footer text-muted" style="background-color: #aec3b0;">Total de tickets: 0 </div>
            </div>
        </div>
    </div>
</form>
@stop