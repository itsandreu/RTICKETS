@if ($ticket->adjuntos != '')
                                            @foreach ($adjuntos as $file)
                                                @if (strpos($file, '.jpg') !== false || strpos($file, '.jpeg') !== false || strpos($file, '.JPG') !== false || strpos($file, '.PNG') !== false || strpos($file, '.png') !== false || strpos($file, '.gif') !== false)
                                                    <div class="col" style="text-align: center;">  
                                                        <!-- Modal action -->
                                                        <div class="col-sm-6 col-md-4 col-lg-3 mb-1">
                                                            <div class="image-wrapper">
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalId-{{$file->id}}" title="{{$file->nombreoriginal}}">
                                                                    <img src="{{$file->archivo}}" alt="" width="80">
                                                                </a>
                                                                <br>
                                                                <br>
                                                                <div class="row-cols-3">
                                                                <a href="{{ route('eliminararchivo',['id'=>$file->id]) }}">
                                                                    <button type="button" class="btn btn-outline-dark">
                                                                        <i class="bi bi-trash3" onclick="return confirm('¿Quieres Eliminar el archivo?')"></i>
                                                                    </button>
                                                                </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal Body -->
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
                                                        <br>
                                                    </div>
                                                @else
                                                    <div class="col" style="text-align: center;"> 
                                                        <div class="col-sm-6 col-md-4 col-lg-6 mb-4">
                                                            <div class="image-wrapper">
                                                                <a href="{{$file->archivo}}" download >
                                                                    <img src="/adjuntos/archivo.png" alt="" width="80" title="{{$file->nombreoriginal}}">
                                                                </a>
                                                                <br>
                                                                <a href="{{ route('eliminararchivo',['id'=>$file->id]) }}">
                                                                    <button type="button" class="btn btn-outline-dark">
                                                                        <i class="bi bi-trash3" onclick="return confirm('¿Quieres Eliminar el archivo?')"></i>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                        @endif 