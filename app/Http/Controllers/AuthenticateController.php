<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Hash;

class AuthenticateController extends Controller
{
    public function dologin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials))
        {
            $request->session()->regenerate();

            if (auth()->user()->role_id === 1) {
                // jika user superadmin
                return redirect()->intended('/products');
            } else {
                // jika user pegawai
                return redirect()->intended('/shopper');
            }
        }


        else{
            return back()->with('error', 'email atau password salah');
        }

    }
    public function doregister(Request $request){
        $request->validate([
            'name' => 'required|string|min:5|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ],[
            'name.required'=>'isi nama dulu dong',
            'email.required'=>'isi email dulu dong',
            'password.required'=>'isi password dulu dong'
        ]);

        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role_id'=> '2'
        ]);
        
        return redirect()->route('home')->with(['success' => 'Berhasil daftar']);
        }
    public function logout(Request $request){

        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
