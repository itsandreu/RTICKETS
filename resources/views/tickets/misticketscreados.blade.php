@extends('template.index')
@section('contenido')
@include('sweetalert::alert')

<div class="card shadow mb-4">
    <div class="card-header py-3 text-center text-color-black" style="background-color:#1b998b;">
        
        <div class="float-start m-0">
            <a href="{{route('crearticket')}}">
                <button type="button" class="btn btn-secondary"><b>Nuevo Ticket</b></button>
            </a>
        </div>
        <h4 class=" justify-content-start font-weight-bold text-dark-emphasis" style="color:aliceblue;"><b>MIS TICKETS</b></h6>
        <div class="float-start m-0">
        </div>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-13">
                        <table id="tickets" class="table table-striped shadow-lg mt-4" style="width:100%">
                            <thead class="bg-dark text-black" style="text-align: center;">
                                <tr style="background-color:#bfd8bd;">
                                    <th scope="col" style="text-align: center;">NºTicket</th>
                                    <th scope="col" style="text-align: center;"><i class="bi bi-chevron-double-right">&nbsp;&nbsp;</i>Autor</th>
                                    <th scope="col" style="text-align: center;"><i class="bi bi-pin-fill">&nbsp;&nbsp;</i>Asignado</th>
                                    <th scope="col" style="text-align: center;">Estado</th>
                                    <th scope="col" style="text-align: center;">Priodiad</th>
                                    <th scope="col" style="text-align: center;">Creado</th>
                                    <th scope="col" style="text-align: center;">Titulo</th>
                                    <th scope="col-3" style="text-align: center;">Descripcion</th>
                                    <th scope="col" style="text-align: center;">Actualizado Ultima vez</th>
                                    <th scope="col" style="text-align: center;">Adjuntos</th>
                                    <th scope="col" style="text-align: center;"><i class="bi bi-gear-fill">&nbsp;&nbsp;&nbsp;&nbsp;</i>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                <tr style="text-align: center; background-color:#e9f5db;">
                                    <td> {{$ticket->id}}</td>

                                    <td>{{$ticket->usuario->name}} {{$ticket->usuario->apellidos}}</td>
                                    
                                    <td style="background-color: #edf2fb; min-width: 130px;">{{$ticket->asignadoA->name}} {{$ticket->asignadoA->apellidos}}</td>
                                    
                                    @if ($ticket->estado->name == 'Abierto')
                                    <td style="background-color: #52b788;">{{$ticket->estado->name}}</td>  
                                    @elseif ($ticket->estado->name == 'Cerrado')
                                    <td style="background-color: #ff99ac;">{{$ticket->estado->name}}</td>  
                                    @else
                                    <td style="background-color:#b5e2fa;">{{$ticket->estado->name}}</td>
                                    @endif
                                    @if ($ticket->prioridad->name == 'Alta')
                                    <td style="background-color: #f25c54;">{{$ticket->prioridad->name}}</td>
                                    @elseif ($ticket->prioridad->name == 'Media')
                                    <td style="background-color: #f7b267;">{{$ticket->prioridad->name}}</td>
                                    @else
                                    <td style="background-color: #ffe5d9;">{{$ticket->prioridad->name}}</td>
                                    @endif
                                    <td>{{$ticket->created_at}}</td>
                                    <td>{{$ticket->titulo}}</td>
                                    <td class="text-truncate" style="max-width: 150px;">{{$ticket->descripcion}}</td>
                                    @if ($ticket->updated_by == '')
                                        <td style="min-width: 200px;"></td>
                                    @else
                                    <td style="min-width: 200px;">{{$ticket->actualizado->name}} {{$ticket->actualizado->apellidos}}</td>
                                    @endif
                                    <td style="min-width: 200px;">
                                        @foreach($ticket->adjuntos as $adjunto)
                                            {{ $adjunto->nombreoriginal }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-outline-dark" href="{{ route('verticket',['id'=>$ticket->id]) }}">
                                                <i class="bi bi-eyeglasses"></i>
                                            </a>
                                            &nbsp;
                                            <a class="btn btn-outline-dark" href="{{ route('editarticket',['id'=>$ticket->id]) }}">
                                                <i class="bi bi-brush"></i>
                                            </a>
                                            &nbsp;
                                            <a class="btn btn-outline-dark" onclick="confirmationdeleteticket(event)" href="{{ route('eliminarticket',['id'=>$ticket->id]) }}">
                                                <i class="bi bi-trash3"></i>
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

