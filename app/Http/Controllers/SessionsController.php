<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function  create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        $user  = User::create([
            'name' => $request->name,
            'eamil' => $request->eamil,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);
        session()->flath('success','欢迎,您将在这里开启一段新的旅程~');
        return redirect()->route('users.show',[$user]);
    }
}
