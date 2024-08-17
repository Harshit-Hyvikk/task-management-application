<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "required|confirmed|min:2",
            "age" => "required|numeric|min:12",
            "role" => "required|String",
        ]);

        $user = User::create($data);

        if ($user) {
            return redirect()->route('login')->with("success", "Register Successfull!, Now Login first!!");
        }
    }

    public function login(Request $request)
    {
        $userdata = $request->validate([
            "email" => "required",
            "password" => "required|min:2",
        ]);

        if (Auth::attempt($userdata)) {
            $request->session()->put('user', Auth::user());
            return redirect()->route('alltasks.index');
        } else {
            return redirect()->route('login');
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with("success", "Logout Successfull!");
    }
}
