<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AdminRemove extends Command
{
    protected $signature = 'admin:remove';
    protected $description = 'Verwijder het admin account (admin@snelopzoek.net)';

    public function handle(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@snelopzoek.net');
        $user = User::where('email', $email)->first();

        if (! $user) {
            $this->warn("Geen account gevonden met e-mail: {$email}");
            return;
        }

        $user->delete();
        $this->info("Admin account ({$email}) succesvol verwijderd.");
    }
}
