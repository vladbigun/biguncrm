<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
   public function getAuth(){
       return view('auth');
   }

   public function postAuth(Request $req){
       //User::create([
       //	'email' => $req->input('email'),
       //	'login' => $req->input('login'),
       //	'password' => bcrypt($req->input('password')),
       //]);

   	   if(!Auth::attempt( $req->only(['email', 'password']), $req->has('remember'))){
   	   		return redirect()->back()->with('info', 'Неправильный логин или пароль');
   	   }
   	   return redirect('/')->with('info', 'Вы авторизованы.');
   }
   public function logout(){
   	   Auth::logout();
   	   return redirect()->route('auth');
   }
}
