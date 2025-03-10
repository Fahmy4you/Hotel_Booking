<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() {
        return view('auth/login', [
            'title' => 'Login Page'
        ]);
    }

    public function loginPost(Request $request) {
        $validData = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
        ]);
        
        if(Auth::attempt($validData)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        } 

        return redirect()->route('login')->with('error', 'Login failed, data does not match');
    }
    
    public function register() {
        return view('auth/register', [
            'title' => 'Register Page'
        ]);
    }

    public function registerPost(Request $request) {
        $validData = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|unique:users|email:rfc,dns',
            'password' => 'required|min:8|confirmed',
        ]);

        $validData['password'] = bcrypt($validData['password']);
        $validData['role_id'] = 1;

        $user = User::create($validData);

        if(Auth::login($user)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        } 

        return redirect()->route('login')->with('succes', 'Registration successful please login');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('succes', 'You has been Log Out');
    }
    
}
