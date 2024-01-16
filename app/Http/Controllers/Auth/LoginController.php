<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
     public function showLogin() {
     if (Auth::check()) {
          return redirect()->back();
     }     
     return view('client.modules.user.login');
     }
     
     public function login(LoginRequest $request) {
     $credentials = [
          'email' => $request->email,
          'password' => $request->password,
     ];
     if (Auth::attempt($credentials) && Auth::user()->level <= 2) {
          return redirect()->route('admin.dashboard');
     } if (Auth::attempt($credentials) && Auth::user()->level > 2) {
          return redirect()->route('client.index');
     }
     return redirect()->back(); 
     }

}
