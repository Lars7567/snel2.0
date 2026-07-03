<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SetupController extends Controller
{
    public function index()
    {
        if (User::exists()) {
            abort(404);
        }

        return view('setup');
    }

    public function store(Request $request)
    {
        if (User::exists()) {
            abort(404);
        }

        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'email_verified_at' => now(),
        ]);

        return redirect('/login')->with('status', 'Admin account aangemaakt. Je kunt nu inloggen.');
    }
}
