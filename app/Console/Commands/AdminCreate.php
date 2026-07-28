<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminCreate extends Command
{
    protected $signature = 'admin:create {--name=} {--email=} {--password=}';
    protected $description = 'Maak een admin-account aan (bv. via SSH of de Plesk Laravel-tool)';

    public function handle(): int
    {
        $name  = $this->option('name')  ?: $this->ask('Naam');
        $email = $this->option('email') ?: $this->ask('E-mailadres');

        if (User::where('email', $email)->exists()) {
            $this->error("Er bestaat al een account met e-mailadres: {$email}");
            return self::FAILURE;
        }

        $password = $this->option('password');
        if (! $password) {
            $password = $this->secret('Wachtwoord (min. 8 tekens)');
            if ($password !== $this->secret('Bevestig wachtwoord')) {
                $this->error('Wachtwoorden komen niet overeen.');
                return self::FAILURE;
            }
        }

        $validator = Validator::make(compact('name', 'email', 'password'), [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return self::FAILURE;
        }

        User::create([
            'name'              => $name,
            'email'             => $email,
            'password'          => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        $this->info("Admin-account aangemaakt: {$email}");
        return self::SUCCESS;
    }
}
