<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarCambiosTicketRequest;
use App\Http\Requests\GuardarTicketRequest;
use App\Models\Adjunto;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Estado;
use App\Models\Prioridad;
use App\Models\Comentario;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class TicketsController extends Controller
{
    public function vertickets(){
        $tickets= Ticket::all();
        return view('tickets.vertickets')->with('tickets',$tickets);
    }
    public function misticketsasignados($id){
        $tickets = Ticket::where('asignado',$id)->get();
        return view('tickets.mistickets')->with('tickets',$tickets);
    }
    public function misticketscreados($id){
        $tickets = Ticket::where('id_user',$id)->get();
        return view('tickets.misticketscreados')->with('tickets',$tickets);
    }
    public function verticket($id){
        $ticket = Ticket::where('id',$id)->first();
        $user = User::withTrashed()->where('id', $id)->first();
        $prioridades = Prioridad::all();
        $estados = Estado::all();
        $adjuntos = Adjunto::where('id_ticket',$id)->get();
        $comentarios = Comentario::where('id_ticket',$id)->get();
        return view('tickets.verticket', compact('ticket','user','estados','prioridades','adjuntos','comentarios'));
    }

    public function crearticket(){
        $estados = Estado::all();
        $prioridades  = Prioridad::all();
        $users = User::all();
        return view('tickets.crearticket')->with('estados',$estados)
                                            ->with('prioridades',$prioridades)
                                            ->with('users',$users);
    }

    public function guardarticket(GuardarTicketRequest $request){
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
                $ruta = public_path('adjuntos');

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
        Alert::success('Creado!','Ticket Creado Correctamente');
        return redirect()->route('tickets');
    }

    public function editarticket($id){

        $ticket = Ticket::where('id',$id)->first();
        $users = User::all();
        $prioridades = Prioridad::all();
        $estados = Estado::all();
        $adjuntos = Adjunto::where('id_ticket',$id)->get();

        
        return view('tickets.editarticket', compact('ticket','users','estados','prioridades','adjuntos'));
    }

    public function guardarcambiosticket(GuardarCambiosTicketRequest $request){
            $id = $request->id;
            $id_user = $request->id_user;
            $id_estado = $request->id_estado;
            $id_prioridad = $request->id_prioridad;
            $asignado = $request->asignado;
            $titulo = $request->titulo;
            $descripcion = $request->descripcion;
            $actualizado = $request->updated_by;

            $ticket = Ticket::where('id',$id)->first();

            $ticket->id_user = $id_user;
            $ticket->id_estado = $id_estado;
            $ticket->id_prioridad = $id_prioridad;
            $ticket->asignado = $asignado;
            $ticket->titulo = $titulo;
            $ticket->descripcion = $descripcion;
            $ticket->updated_by = $actualizado;
            $ticket->save();

            if($request->hasfile('adjuntos')){
                $adjuntos = $request->file('adjuntos');
    
                for ($i = 0; $i < count($adjuntos); $i++){
                    $rutasdb = "/adjuntos/";
                    $ruta = public_path('adjuntos');
    
                    $filename = $id . $adjuntos[$i]->getClientOriginalName();
                    $rutasdb .= $filename;
                    
                    $adjuntos[$i]->move($ruta,$filename);
    
                    $adjunto = new Adjunto;
                    $adjunto->id_ticket = $id;
                    $adjunto->nombreoriginal = $filename;
                    $adjunto->archivo = $rutasdb;
                    $adjunto->save();
                }
            }
            Alert::toast('Actualizado','success');
            return redirect()->back();
    }

    
    public function eliminarticket($id){
        $adjuntos = Adjunto::where('id_ticket',$id)->get();
        foreach ($adjuntos as $adjunto) {
            $file_path = public_path().$adjunto->archivo;
            if(File::exists($file_path)) {
                File::delete($file_path);
            }
            $adjunto->delete();
        }
        Ticket::find($id)->forceDelete();
        
        return redirect()->route('tickets');
    }

    public function eliminararchivo($id){
        $adjuntos = Adjunto::where('id',$id)->get();
        foreach ($adjuntos as $adjunto) {
            $file_path = public_path().$adjunto->archivo;
            if(File::exists($file_path)) {
                File::delete($file_path);
            }
            $adjunto->delete();
        }
        return redirect()->back();
    }
}