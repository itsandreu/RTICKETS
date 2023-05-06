<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    public function register(){
        return view('auth.register');
    }
    public function registerVerify(Request $request){
        $request->validate([
            'name' => 'required',
            'apellidos' => 'required',
            'nacimiento' => 'required',
            'dni' => 'required|unique:users,dni',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ],[
            'name.required' => 'El nombre es requerido',
            'apellidos.required' => 'El Apellido es requerido',
            'nacimiento.required' => 'La fecha de nacimiento es requerida',
            'dni.required' => 'El dni es requerido',
            'dni.unique' => 'Este dni ya existe',
            'email.required' => 'El email es requerido',
            'email.unique' => 'El email ya esta en uso',
            'password.required' => 'La contraseña es requerida'
        ]);
        
        if($request->file('foto')){
            if($request->file('foto')){
                $file = $request->file('foto');
                $ruta = "/Applications/XAMPP/xamppfiles/htdocs/Rtickets/public/fotos";
                $filename = time() . '-' . $file->getClientOriginalName();
                $rutadb = "/fotos/". $filename;
                $request->file('foto')->move($ruta,$filename);
            }
        }
        else{
            $filename = "sinfoto.jpg";
            $rutadb = "/fotos/sinfoto.jpg";
        }
        User::create([
            'name' => $request->name,
            'apellidos' => $request->apellidos,
            'nacimiento' => $request->nacimiento,
            'dni' => $request->dni,
            'foto' => $filename,
            'url_foto' => $rutadb,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
    Alert::Success('Usuario Registrado');
    return redirect()->route('users');
    }

    public function login(){
        return view('auth.login');
    }
    public function loginverify(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ],[
            'email.required' => 'El email es requerido',
            'email.unique' => 'El email ya esta en uso',
            'password.required' => 'La contraseña es requerida'
        ]);

        if ($request->input('remember_token')) {
            $remember = true;
        } else {
            $remember = false;
        }

        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $remember)){
            $request->session()->regenerate();
            return redirect('dashboard')->with('bienvenido', 'Bienvenido al sistema');
        }
        return back()->withErrors(['invalid_credentials' => 'Usuario o Contraseña Incorrecto'])->withInput();
    }

    public function signout(){
        Auth::logout();
        return redirect()->route('login')->with('success', '!   Hasta Pronto   ¡');
    }
}
