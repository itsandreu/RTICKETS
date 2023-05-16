<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarUsuarioRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Ticket;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{
    //
    public function verusers(){
        $consulta = User::all();
        return view('users.verusers')->with('consulta',$consulta);
    }

    public function veruser($id){
        if($id == auth()->id()){
            $consulta = User::withTrashed()->where('id', $id)->first();
            $asignados = Ticket::where('asignado',$id)->count();
            $creados = Ticket::where('id_user',$id)->count();
            //dd($asignados);
            return view('users.veruser', compact('consulta','asignados','creados'));
        }else{
            try{
                $this->authorize('admin-only');
                $consulta = User::withTrashed()->where('id', $id)->first();
                $asignados = Ticket::where('asignado',$id)->count();
                $creados = Ticket::where('id_user',$id)->count();
                //dd($asignados);
                return view('users.veruser', compact('consulta','asignados','creados'));
            }catch (AuthorizationException $e) {
                Alert::toast('No tiene Permisos','warning');
                return redirect()->back();
            }
        }
    }

    public function editarusers($id){
        if($id == auth()->id()){
            $consulta = User::withTrashed()->where('id', $id)->first();
            return view('users.editaruser', compact('consulta'));
        }else{
            try{
                $this->authorize('admin-only');
                $consulta = User::withTrashed()->where('id', $id)->first();
                return view('users.editaruser', compact('consulta'));
            }catch (AuthorizationException $e) {
                Alert::toast('No tiene Permisos','warning');
                return redirect()->back();
            }
        }
    }
    public function guardarcambiosuser(GuardarUsuarioRequest $request){
        $id = $request->id;
        if($id == auth()->id()){
            if($request->file('foto')){
                $id = $request->id;
                $user = User::where('id',$id)->first();
                $foto = $user->url_foto;
                if($foto == 'sinfoto.jpg'){
                    $file = $request->file('foto');
                    $ruta = "/Applications/XAMPP/xamppfiles/htdocs/Rtickets/public/fotos";
                    $filename = time() . '-' . $file->getClientOriginalName();
                    $rutadb = "/fotos/". $filename;
                    $request->file('foto')->move($ruta,$filename);
                }else{
                    $file = $request->file('foto');
                    $ruta = "/Applications/XAMPP/xamppfiles/htdocs/Rtickets/public/fotos";
                    $filename = time() . '-' . $file->getClientOriginalName();
                    $rutadb = "/fotos/". $filename;
                    $request->file('foto')->move($ruta,$filename);
                
                    $file_path = public_path().$foto;
                    if(File::exists($file_path)) {
                        File::delete($file_path);
                    }
                }
            }else{
                $filename = "sinfoto.jpg";
                $rutadb = "/fotos/sinfoto.jpg";
            }
        
            $id = $request->id;
            $user = User::where('id',$id)->first();
            $foto = $user->foto;
        
        
            $user->name = $request->name;
            if($user->dni != $request->dni){
                $user->dni = $request->dni;
            }
            $user->apellidos = $request->apellidos;
            $user->nacimiento = $request->nacimiento;
            $user->email = $request->email;
            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }
            if($request->file('foto')){
                $user->foto = $filename;
                $user->url_foto = $rutadb;
            }
            $user->save();
            Alert::toast('Usuario Actualizado','success');
            return redirect()->route('users')->with('usuario',$user->name);
        }else{
            try{
                $this->authorize('admin-only');
                if($request->file('foto')){
                    $id = $request->id;
                    $user = User::where('id',$id)->first();
                    $foto = $user->url_foto;
                    if($foto == 'sinfoto.jpg'){
                        $file = $request->file('foto');
                        $ruta = "/Applications/XAMPP/xamppfiles/htdocs/Rtickets/public/fotos";
                        $filename = time() . '-' . $file->getClientOriginalName();
                        $rutadb = "/fotos/". $filename;
                        $request->file('foto')->move($ruta,$filename);
                    }else{
                        $file = $request->file('foto');
                        $ruta = "/Applications/XAMPP/xamppfiles/htdocs/Rtickets/public/fotos";
                        $filename = time() . '-' . $file->getClientOriginalName();
                        $rutadb = "/fotos/". $filename;
                        $request->file('foto')->move($ruta,$filename);

                        $file_path = public_path().$foto;
                        if(File::exists($file_path)) {
                            File::delete($file_path);
                        }
                    }
                }else{
                    $filename = "sinfoto.jpg";
                    $rutadb = "/fotos/sinfoto.jpg";
                }

                $id = $request->id;
                $user = User::where('id',$id)->first();
                $foto = $user->foto;


                $user->name = $request->name;
                if($user->dni != $request->dni){
                    $user->dni = $request->dni;
                }
                $user->apellidos = $request->apellidos;
                $user->nacimiento = $request->nacimiento;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                if($request->file('foto')){
                    $user->foto = $filename;
                    $user->url_foto = $rutadb;
                }
                $user->save();

                Alert::toast('Usuario Actualizado','success');
                return redirect()->route('users')->with('usuario',$user->name);
                
            }catch (AuthorizationException $e) {
                Alert::toast('No tiene Permisos','warning');
                return redirect()->back();
            }
        }
    }

    public function deshabilitarusers($id){
        try{
            $this->authorize('admin-only');
            $user=User::find($id);
            $user->delete();
            return redirect()->route('users')->with('success','Usuario Deshabilitado');
        }catch (AuthorizationException $e) {
            Alert::toast('No tiene Permisos','warning');
            return redirect()->back();
        }
    }

    public function disabledusers(){
        try{
            $this->authorize('admin-only');
            $users = User::onlyTrashed()->get();
            return view('users.disabledusers')->with('users',$users);
        }catch (AuthorizationException $e) {
            Alert::toast('No tiene Permisos','warning');
            return redirect()->back();
    }
    }

    public function activarusers($id){
        try{
            $this->authorize('admin-only');
            $user=User::withTrashed()->where('id',$id)->restore();
            return redirect()->route('disabledusers');
        }catch (AuthorizationException $e) {
            Alert::toast('No tiene Permisos','warning');
            return redirect()->back();
    }}

    public function eliminarusers($id){
        try{
            $this->authorize('admin-only');
            $user=user::withTrashed()->find($id)->forceDelete();
            return redirect()->route('disabledusers');
        }catch (AuthorizationException $e) {
            Alert::toast('No tiene Permisos','warning');
            return redirect()->back();
        }
    }
}