<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register() {
        return view('auth.register');
    }

    public function storeRegister(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login');
    }

    public function login() {
        return view('auth.login');
    }

    public function storeLogin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Datele sunt invalide']);
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

    public function dashboard() {
        $user = Auth::user();

        return view('dashboard', compact('user'));
    }

    public function userList() {
    $user = Auth::user();
    $users = null;

    if ($user->role === 'admin') {
        $users = User::all();
    }

    return view('admin', compact('user', 'users'));
}

}
