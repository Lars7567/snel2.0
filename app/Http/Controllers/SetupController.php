<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class SetupController extends Controller
{
    public function index(Request $request)
    {
        $this->guard($request);

        return view('setup', ['key' => $request->query('key')]);
    }

    public function store(Request $request)
    {
        $this->guard($request);

        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Serialize this block so two near-simultaneous requests can't both
        // pass the User::exists() check and create duplicate admin accounts.
        Cache::lock('setup-account-creation', 10)->block(5, function () use ($request) {
            if (User::exists()) {
                abort(404);
            }

            User::create([
                'name'              => $request->name,
                'email'             => $request->email,
                'password'          => Hash::make($request->password),
                'email_verified_at' => now(),
            ]);
        });

        return redirect('/login')->with('status', 'Admin account aangemaakt. Je kunt nu inloggen.');
    }

    private function guard(Request $request): void
    {
        $setupKey = config('app.setup_key');
        $given    = (string) $request->query('key', $request->input('key', ''));

        if (! $setupKey || ! hash_equals((string) $setupKey, $given)) {
            abort(404);
        }

        if (User::exists()) {
            abort(404);
        }
    }
}
