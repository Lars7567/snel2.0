<?php

namespace App\Http\Controllers;

use App\Helpers\ContentHelper;
use App\Models\Bedrijf;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SettingsController extends Controller
{
    private string $storagePath;

    public function __construct()
    {
        $this->storagePath = storage_path('app/branding.json');
    }

    public function index()
    {
        $settings = $this->loadSettings();
        $content  = ContentHelper::load();

        // Stijl-tab data
        $fonts  = ['Arial', 'Inter', 'Roboto', 'Poppins', 'Lato', 'Open Sans', 'Montserrat'];
        $dir    = public_path('images');
        $images = [];
        foreach (glob($dir . '/*') ?: [] as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'])) {
                $images[] = '/images/' . basename($file);
            }
        }
        sort($images);

        // Import/Export-tab data
        $bedrijven   = Bedrijf::with('categorieen')->orderBy('naam')->get();
        $categorieen = Categorie::orderBy('categorie')->get();

        return view('admin.settings', compact('settings', 'content', 'fonts', 'images', 'bedrijven', 'categorieen'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'contact_email'    => ['required', 'email', 'max:255'],
            'site_phone'       => ['nullable', 'string', 'max:50'],
            'site_hours'       => ['nullable', 'string', 'max:100'],
            'mail_host'        => ['nullable', 'string', 'max:255'],
            'mail_port'        => ['nullable', 'integer'],
            'mail_username'    => ['nullable', 'string', 'max:255'],
            'mail_password'    => ['nullable', 'string', 'max:255'],
            'mail_encryption'  => ['nullable', 'in:tls,ssl,'],
            'mail_from_name'   => ['nullable', 'string', 'max:255'],
            'footer_facebook'  => ['nullable', 'url', 'max:255'],
            'footer_instagram' => ['nullable', 'url', 'max:255'],
            'footer_linkedin'  => ['nullable', 'url', 'max:255'],
            'footer_twitter'   => ['nullable', 'url', 'max:255'],
            'av_content'       => ['nullable', 'string'],
            'av_pdf'           => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
        ]);

        $settings = $this->loadSettings();
        $settings['contact_email']    = $request->input('contact_email');
        $settings['site_phone']       = $request->input('site_phone', '');
        $settings['site_hours']       = $request->input('site_hours', '');
        $settings['mail_type']        = $request->input('mail_type', 'phpmail');
        $settings['mail_from_address'] = $request->input('mail_from_address', '');
        $settings['mail_from_name']   = $request->input('mail_from_name', 'Bedrijfsvermelding');
        $settings['mail_host']        = $request->input('mail_host', '');
        $settings['mail_port']        = (int) $request->input('mail_port', 587);
        $settings['mail_username']    = $request->input('mail_username', '');
        $settings['mail_encryption']  = $request->input('mail_encryption', 'tls');
        $settings['footer_facebook']  = $request->input('footer_facebook', '');
        $settings['footer_instagram'] = $request->input('footer_instagram', '');
        $settings['footer_linkedin']  = $request->input('footer_linkedin', '');
        $settings['footer_twitter']   = $request->input('footer_twitter', '');
        $settings['av_content']       = $request->input('av_content', '');

        // Alleen wachtwoord overschrijven als er een nieuw is ingevuld
        if ($request->filled('mail_password')) {
            $settings['mail_password'] = $request->input('mail_password');
        }

        // PDF verwijderen als aangevinkt
        if ($request->boolean('av_pdf_delete')) {
            $existing = $settings['av_pdf'] ?? '';
            if ($existing && file_exists(public_path('files/' . $existing))) {
                unlink(public_path('files/' . $existing));
            }
            $settings['av_pdf'] = '';
        }

        // Nieuw PDF uploaden
        if ($request->hasFile('av_pdf')) {
            $existing = $settings['av_pdf'] ?? '';
            if ($existing && file_exists(public_path('files/' . $existing))) {
                unlink(public_path('files/' . $existing));
            }
            $filename = 'av_' . time() . '.pdf';
            $request->file('av_pdf')->move(public_path('files'), $filename);
            $settings['av_pdf'] = $filename;
        }

        file_put_contents($this->storagePath, json_encode($settings, JSON_PRETTY_PRINT));

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Instellingen opgeslagen!']);
        }
        return redirect()->route('admin.settings')->with('success', 'Instellingen opgeslagen!');
    }

    public function testMail(Request $request)
    {
        $settings = $this->loadSettings();
        $toEmail  = $settings['contact_email'] ?? '';

        if (empty($toEmail)) {
            if ($request->ajax()) return response()->json(['success' => false, 'message' => 'Vul eerst een ontvangst e-mailadres in en sla op.']);
            return back()->with('mail_test_error', 'Vul eerst een ontvangst e-mailadres in en sla op.');
        }

        $fromAddress = $settings['mail_from_address'] ?? $toEmail;
        $fromName    = $settings['mail_from_name']    ?? 'Bedrijfsvermelding';

        if (($settings['mail_type'] ?? 'phpmail') === 'smtp' && !empty($settings['mail_host'])) {
            config([
                'mail.default'                 => 'smtp',
                'mail.mailers.smtp.host'       => $settings['mail_host'],
                'mail.mailers.smtp.port'       => $settings['mail_port']       ?? 587,
                'mail.mailers.smtp.username'   => $settings['mail_username']   ?? '',
                'mail.mailers.smtp.password'   => $settings['mail_password']   ?? '',
                'mail.mailers.smtp.encryption' => $settings['mail_encryption'] ?: 'tls',
                'mail.from.address'            => $fromAddress,
                'mail.from.name'               => $fromName,
            ]);
        } else {
            config([
                'mail.default'      => 'sendmail',
                'mail.from.address' => $fromAddress,
                'mail.from.name'    => $fromName,
            ]);
        }

        try {
            Mail::raw('Dit is een testmail vanuit het admin-paneel van ' . config('app.name') . '. Als je dit ontvangt werkt de e-mailconfiguratie correct.', function ($message) use ($toEmail) {
                $message->to($toEmail)
                        ->subject('Testmail — e-mailconfiguratie werkt');
            });

            $msg = 'Testmail verzonden naar ' . $toEmail . '. Controleer je inbox (en spam).';
            if ($request->ajax()) return response()->json(['success' => true,  'message' => $msg]);
            return back()->with('mail_test_success', $msg);
        } catch (\Exception $e) {
            $msg = 'Verzenden mislukt: ' . $e->getMessage();
            if ($request->ajax()) return response()->json(['success' => false, 'message' => $msg]);
            return back()->with('mail_test_error', $msg);
        }
    }

    private function loadSettings(): array
    {
        if (file_exists($this->storagePath)) {
            $data = json_decode(file_get_contents($this->storagePath), true);
            if (is_array($data)) {
                return $data;
            }
        }
        return [];
    }
}
