<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOnboarded
{
    /**
     * Stuurt naar de onboarding-wizard zolang de website nog nooit is
     * ingericht. Dit is een blijvende, van gebruikers losstaande vlag: ook
     * als het eerste account later verwijderd en opnieuw aangemaakt wordt,
     * hoeft de wizard niet nogmaals te worden doorlopen.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Alleen navigatie (GET) omleiden. POST/DELETE laten we altijd door,
        // anders zou de wizard zijn eigen opslag-aanroepen (die dezelfde
        // admin-routes gebruiken als het instellingenscherm) blokkeren.
        if (
            $request->isMethod('get')
            && ! $request->routeIs('onboarding.*')
            && ! file_exists(storage_path('app/onboarding_completed'))
        ) {
            return redirect()->route('onboarding.index');
        }

        return $next($request);
    }
}
