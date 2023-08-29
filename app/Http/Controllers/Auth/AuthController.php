<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function index()
    {
        return view('auth.login');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    public function login(Request $request){
        $users = $request->only('name', 'password');
        if (auth()->attempt($users)) {
            if (auth()->user()->role == 'admin') {
                return redirect('/admin');
            } else {
                return redirect('/karyawan');
            }
        } else {
            return redirect('/');
        }
    }
}
