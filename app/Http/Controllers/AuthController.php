<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request; use App\Models\User; use Illuminate\Support\Facades\Hash; use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin(){ return view('auth.login'); }
    public function showRegister(){ return view('auth.register'); }
    public function register(Request $r){
        $data = $r->validate(['name'=>'required','email'=>'required|email','password'=>'required|min:6']);
        $user = User::create(['name'=>$data['name'],'email'=>$data['email'],'password'=>Hash::make($data['password'])]);
        Auth::login($user);
        return redirect()->route('dashboard');
    }
    public function login(Request $r){
        $creds = $r->only('email','password');
        if(Auth::attempt($creds)) return redirect()->route('dashboard');
        return back()->withErrors(['email'=>'Credenciais inválidas']);
    }
    public function logout(){ Auth::logout(); return redirect()->route('login'); }
}
