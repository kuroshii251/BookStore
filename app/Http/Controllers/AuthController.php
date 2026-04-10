<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function registers()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        if ($Validator->fails()) {
            return back()->withErrors($Validator->errors());
        }

        $user = $request->except(['confirm_password']);
        $user['password'] = bcrypt($user['password']);
        User::create($user);

                    return view('auth.login');

    }

    public function logins()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if ($credentials['email'] == 'admin1234@gmail.com' && $credentials['password'] == 'Admin123') {
                return redirect()->to('/admindashboard');
            }
                    return redirect()->to('/dashboard');
        }
        return back()->withErrors(['message' => 'error']);
    }


    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('index')->with('success', 'berhasil');

    }


}
