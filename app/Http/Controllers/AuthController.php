<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if(Auth::check()) {
            return redirect()->route('home.index');
        }
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register()
    {
        $works = Work::all();
        return view('auth.register', compact('works'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'work' => 'required|array|min:3',
            'phone' => 'required|numeric',
            'gender' => 'required|in:male,female',
            'linkedin' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'amount' => 'required|numeric|min:100000',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'gender' => $request->gender,
            'linkedin' => $request->linkedin,
            'password' => $request->password,
        ]);

        if($request->amount >= 100000) {
            $coins = $request->amount / 1000;
            $user->update(['coins' => $coins]);
        }

        $user->works()->attach($request->work);

        Auth::login($user);

        return redirect()->route('home.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home.index');
    }
}
