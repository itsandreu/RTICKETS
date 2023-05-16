<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearComentarioRequest;
use App\Models\Comentario;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ComentariosController extends Controller
{
    //
    public function crearcomentario(CrearComentarioRequest $request)
    {
        $titulo = $request->titulo;
        $comentario_texto = $request->comentario;
        $id_ticket = $request->id_ticket;
        $id_user = $request->id_user;

        $comentario = new Comentario;
        $comentario->titulo = $titulo;
        $comentario->comentario = $comentario_texto;
        $comentario->id_ticket = $id_ticket;
        $comentario->user_id = $id_user;
        $comentario->save();
        Alert::success('Creado!','Comentario posteado correctamente');
        return redirect()->route('tickets');
    }
}
