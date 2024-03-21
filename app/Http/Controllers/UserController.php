<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   public function create(){
    return view('users.register');
   }
   public function store(Request $request){
    $validated = $request->validate([
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:6',
    ]);
    $validated ['password']==bcrypt($validated ['password']);

    $user=User::create( $validated);
    auth()->login($user);
      return redirect('/')->with('message','User Created and Logged in ');

   }
   public function logout(Request $request){
      auth()->logout();
      $request->session()->invalidate();// delete for current session
      $request->session()->regenerateToken();
      return redirect('/')->with('message','you have been logged out ! ');

}
public function login(){
    return view('users.login');

}public function authenticate(Request $request){
    $formFields = $request->validate([
        'email' => ['required', 'email'],
        'password' => 'required'
    ]);

    if(auth()->attempt($formFields)) {
        $request->session()->regenerate();

        return redirect('/')->with('message', 'You are now logged in!');
    }

    return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');


}
}
