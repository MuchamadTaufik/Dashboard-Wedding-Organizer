<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{

    public function ShowUserlist(){
        $user = User::all();
        return view('pages.tables', compact('user'),('product'));
    }

    public function create()
    {
        return view('register.create');
    }

    public function store(){

        $attributes = request()->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:13',
            'location' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
        ]);

        $user = User::create($attributes);
        auth()->login($user);
        
        return redirect('/dashboard');
    }
}
