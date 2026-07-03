<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;

class contactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    /**
     * Handle the contact form submission.
     */
    public function store(Request $request)
    {
        // validate the incoming data
        $data = $request->validate([
            'bussiness' => 'nullable|string|max:255',
            'callname'  => 'required|in:man,vrouw',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email',
            'message'   => 'required|string',
        ]);

        $brandingFile = storage_path('app/branding.json');
        $bs = file_exists($brandingFile) ? (json_decode(file_get_contents($brandingFile), true) ?? []) : [];

        $contactEmail = $bs['contact_email'] ?? config('mail.from.address', 'info@example.com');

        $fromAddress = $bs['mail_from_address'] ?? 'info@bedrijfsvermelding.net';
        $fromName    = $bs['mail_from_name']    ?? 'Bedrijfsvermelding';

        if (($bs['mail_type'] ?? 'phpmail') === 'smtp' && !empty($bs['mail_host'])) {
            config([
                'mail.default'                     => 'smtp',
                'mail.mailers.smtp.host'           => $bs['mail_host'],
                'mail.mailers.smtp.port'           => $bs['mail_port']       ?? 587,
                'mail.mailers.smtp.username'       => $bs['mail_username']   ?? '',
                'mail.mailers.smtp.password'       => $bs['mail_password']   ?? '',
                'mail.mailers.smtp.encryption'     => $bs['mail_encryption'] ?: 'tls',
                'mail.from.address'                => $fromAddress,
                'mail.from.name'                   => $fromName,
            ]);
        } else {
            config([
                'mail.default'      => 'sendmail',
                'mail.from.address' => $fromAddress,
                'mail.from.name'    => $fromName,
            ]);
        }

        try {
            Mail::to($contactEmail)->send(new ContactFormSubmitted($data));
            return back()->with('success', 'Uw bericht is verzonden. We nemen spoedig contact met u op.');
        } catch (\Exception $e) {
            return back()->with('error', 'Verzenden mislukt. Probeer het later opnieuw of neem direct contact op.');
        }
    }
}
