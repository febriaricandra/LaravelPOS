<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function index()
    {
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard.index');
                case 'karyawan':
                    return redirect()->route('karyawan.dashboard.index');
                default:
                    return redirect()->back()->with('status', 'Role tidak valid.');
            }
        } else {
            return redirect()->back()->with('status', 'Username atau Password Salah!');
        }
    }
}
