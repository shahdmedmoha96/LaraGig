<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUsergRequest;
use App\Http\Requests\AuthenticateRequest;

class UserController extends Controller
{
    public function create()
    {
        return view('users.register');
    }
    public function store(StoreUsergRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] == bcrypt($validated['password']);

        $user = User::create($validated);
        auth()->login($user);
        return redirect('/')->with('message', 'User Created and Logged in ');
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate(); // delete for current session
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'you have been logged out ! ');
    }
    public function login()
    {
        // dd("gg");
        return view('users.login');
    }
    public function authenticate(AuthenticateRequest $request)
    {
        $formFields = $request->validated();

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
