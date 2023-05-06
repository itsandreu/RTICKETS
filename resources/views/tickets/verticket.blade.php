
@extends('template.index')
@section('contenido')
<div class="card shadow mb-4">
    <div class="card-header text-color-black" style="background-color:#1b998b;">
        <h4 class="float-start font-weight-bold text-dark-emphasis" style="color:aliceblue;"><b>{{$ticket->titulo}}</b></h6>
        <h4 class="float-end font-weight-bold text-dark-emphasis" style="color:aliceblue;"><b>Ticket: {{$ticket->id}} </b></h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header text-center text-color-black" style="background-color:#1b998b;">
                        <h4 class="justify-content-start font-weight-bold text-dark-emphasis" style="color:aliceblue;"><b>Información del ticket</b></h6>
                    </div>
                    <div class="card-body">
                        <br>
                        <h3><b>Titulo: </b></h5>
                        <h7>{{$ticket->titulo}}</h7>
                        <h3><b>Descripcion: </b></h5>
                        <h7>{{$ticket->descripcion}}</h7>
                        <h3><b>Estado: </b></h5>
                        @if ($ticket->estado->name == 'Abierto')
                        <h7 style="background-color: #52b788;">{{$ticket->estado->name}}</h7>
                        @elseif ($ticket->estado->name == 'Cerrado')
                        <h7 style="background-color: #ff99ac;">{{$ticket->estado->name}}</h7>
                        @else
                        <h7 style="background-color:#b5e2fa;">{{$ticket->estado->name}}</h7>
                        @endif
                        <h3><b>Prioridad:</b></h5>
                        @if ($ticket->prioridad->name == 'Alta')
                        <h7 style="background-color: #f25c54;">{{$ticket->prioridad->name}}</h7>
                        @elseif ($ticket->prioridad->name == 'Media')
                        <h7 style="background-color: #f7b267;">{{$ticket->prioridad->name}}</h7>
                        @else
                        <h7 style="background-color: #ffe5d9;">{{$ticket->prioridad->name}}</h7>
                        @endif
                        <br>
                        <br>
                        <a class="btn btn-primary" href="{{ route('editarticket',['id'=>$ticket->id]) }}" role="button">Editar Ticket</a>
                    </div>
                    <div class="card-footer text-white text-muted" style="background-color: #253237;"><!--Escribir texto --></div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header text-center text-color-black" style="background-color:#1b998b;">
                        <h4 class=" justify-content-start font-weight-bold text-dark-emphasis" style="color:aliceblue;"><b>Autor y Adjuntos</b></h6>
                    </div>
                    <div class="card-body overflow-auto" style=" height: 380px;">
                        <div class="row">
                            <div class="col justify-content-center"> 
                                <div class="card" style="width:10rem">
                                    <img src="{{$ticket->usuario->url_foto}}" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$ticket->usuario->name}}</h5>
                                        <p class="card-text">{{$ticket->usuario->apellidos}}</p>
                                        <a href="#" class="btn btn-primary">Ver Perfil</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col justify-content-center">
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
                                                            <a href="{{ route('eliminararchivo',['id'=>$file->id]) }}">
                                                                <button type="button" class="btn btn-outline-dark eliminar-archivo">
                                                                    <i class="bi bi-trash3" onclick="return confirm('¿Quieres Eliminar el Archivo?')"></i>
                                                                </button>
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
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-white text-muted" style="background-color: #253237;"><!--Escribir texto --></div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-white text-muted" style="background-color: #253237;"><!--Escribir texto --></div>
</div>
</div>
<div class="card shadow mb-4 ms-4 me-4">
    <div class="card-header text-color-black" style="background-color:#8da9c4;">
        <h4 class="float-start font-weight-bold text-dark-emphasis" style="color:aliceblue;"><b>Comentarios</b></h6>
        <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Añadir un comentario</button>
    </div>
    <div class="card-body">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo Comentario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('crearcomentario') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Titulo</label>
                                <input type="text" class="form-control" name="titulo" id="titulo">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Comentario</label>
                                <textarea class="form-control" name="comentario" id="comentario"></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" class="form-control" name="id_ticket" id="id_ticket" value="{{$ticket->id}}">
                            </div>
                            <div class="mb-3">
                                <input type="hidden" class="form-control" name="id_user" id="id_user" value="{{Auth::user()->id}}">
                            </div>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Enviar Comentario</button>
                        </div>
                        </form>
                </div>
            </div>
        </div>
        @foreach ($comentarios as $comentario)
        <hr size="4" color="red">
        <table class="table">
            <tbody>
                <tr>
                    <td style="width: 100px;"><img src="{{$comentario->usuario->url_foto}}" height="50px;"></td>
                    <td>{{$comentario->usuario->name}} {{$comentario->usuario->apellidos}}</td>
                    <td style="width: 1000px;"><b>{{$comentario->titulo}}</b><br>{{$comentario->comentario}}</td>
                    <td>{{$comentario->created_at}}</td>
                </tr>
            </tbody>
        </table>
        @endforeach
    </div>
    <div class="card-footer text-white text-muted" style="background-color: #253237;"><!--Escribir texto --></div>
</div>
@stop
