<?php

namespace App\Http\Controllers;

use App\Models\Adjunto;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Estado;
use App\Models\Prioridad;

use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function vertickets(){
        $tickets= Ticket::all();
        return view('tickets.vertickets')->with('tickets',$tickets);
    }

    public function crearticket(){
        $estados = Estado::all();
        $prioridades  = Prioridad::all();
        $users = user::all();
        return view('tickets.crearticket')->with('estados',$estados)
                                            ->with('prioridades',$prioridades)
                                            ->with('users',$users);
    }

    public function guardarticket(Request $request){
        $this->validate($request,[
            'id_user' => 'required',
            'asignado' => 'required',
            'titulo' => 'required',
            'descripcion' => 'required',
            'id_estado' => 'required|regex:/^[0-9]{1}$/',
            'id_prioridad' => 'required|regex:/^[0-9]{1}$/',
            ]);
    
        $id_user = $request->id_user;
        $asignado = $request->asignado;
        $estado = $request->id_estado;
        $titulo = $request->titulo;
        $prioridad = $request->id_prioridad;
        $descripcion = $request->descripcion;

        $tickets = new Ticket;
        $tickets->id_user = $id_user;
        $tickets->asignado = $asignado;
        $tickets->titulo = $titulo;
        $tickets->descripcion = $descripcion;
        $tickets->id_estado = $estado;
        $tickets->id_prioridad = $prioridad;
        $tickets->save();

        $id= Ticket::orderBy('id','DESC')->take(1)->get();
        $id_ticket = $id[0]->id;

        if($request->hasfile('adjuntos')){
            $adjuntos = $request->file('adjuntos');

            for ($i = 0; $i < count($adjuntos); $i++){
                $rutasdb = "/adjuntos/";
                $ruta = "/Applications/XAMPP/xamppfiles/htdocs/Rtickets/public/adjuntos";

                $filename = $id_ticket . $adjuntos[$i]->getClientOriginalName();
                $rutasdb .= $filename;
                
                $adjuntos[$i]->move($ruta,$filename);

                $adjunto = new Adjunto;
                $adjunto->id_ticket = $id_ticket;
                $adjunto->nombreoriginal = $filename;
                $adjunto->archivo = $rutasdb;
                $adjunto->save();
            }
        }
        return redirect()->route('tickets')->with('success','Ticket Creado correctamente');
    }

    public function editarticket($id){

        $ticket = Ticket::where('id',$id)->first();
        $users = User::all();
        $prioridades = Prioridad::all();
        $estados = Estado::all();
        $adjuntos = Adjunto::where('id_ticket',$id)->get();

        
        return view('tickets.editarticket', compact('ticket','users','estados','prioridades','adjuntos'));
    }

    public function eliminarticket($id){
        Ticket::find($id)->forceDelete();
        return redirect()->route('tickets');
    }
}