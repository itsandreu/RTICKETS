<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\User;

class UsersController extends Controller
{
    //
    public function verusers(){
        $consulta = User::all();
        return view('users.verusers')->with('consulta',$consulta);
    }

    public function editarusers($id){
        $consulta = User::withTrashed()->where('id', $id)->first();
        return view('users.editaruser', compact('consulta'));
    }
    public function guardarcambios(Request $request){
        
        $request->validate([
            'name' => 'required',
            'apellidos' => 'required',
            'nacimiento' => 'required',
            'dni' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
        ],[
            'name.required' => 'El nombre es requerido',
            'apellidos.required' => 'El Apellido es requerido',
            'nacimiento.required' => 'La fecha de nacimiento es requerida',
            'dni.required' => 'El DNI es requerido',
            'email.required' => 'El email es requerido',
            'email.unique' => 'El email ya esta en uso',
            'password.required' => 'La contraseña es requerida'
        ]);
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
    
        return redirect()->route('users')->with('success','Usuario Actualizado')
                                        ->with('usuario',$user->name);
    }

    public function deshabilitarusers($id){
        $user=User::find($id);
        $user->delete();
        return redirect()->route('users')->with('success','Usuario Deshabilitado');
    }

    public function disabledusers(){
        $users = User::onlyTrashed()->get();
        return view('users.disabledusers')->with('users',$users);
    }

    public function activarusers($id){
        $user=User::withTrashed()->where('id',$id)->restore();
        return redirect()->route('disabledusers');
    }

    public function eliminarusers($id){
        $user=user::withTrashed()->find($id)->forceDelete();
        return redirect()->route('disabledusers');
    }
    
}
