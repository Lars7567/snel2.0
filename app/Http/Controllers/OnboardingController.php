<?php

namespace App\Http\Controllers;

class OnboardingController extends Controller
{
    private string $storagePath;
    private string $flagPath;

    public function __construct()
    {
        $this->storagePath = storage_path('app/branding.json');
        $this->flagPath    = storage_path('app/onboarding_completed');
    }

    public function index()
    {
        if (file_exists($this->flagPath)) {
            return redirect()->route('admin.index');
        }

        $settings = $this->loadSettings();

        $dir    = public_path('images');
        $images = [];
        foreach (glob($dir . '/*') ?: [] as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'])) {
                $images[] = '/images/' . basename($file);
            }
        }
        sort($images);

        return view('onboarding.wizard', compact('settings', 'images'));
    }

    // Zet de blijvende vlag: dit account of een later account hoeft de
    // wizard hierna nooit meer te zien, ongeacht toekomstige account-wissels.
    public function complete()
    {
        file_put_contents($this->flagPath, now()->toDateTimeString());

        return response()->json(['success' => true, 'redirect' => route('admin.index')]);
    }

    private function loadSettings(): array
    {
        if (file_exists($this->storagePath)) {
            $data = json_decode(file_get_contents($this->storagePath), true);
            if (is_array($data)) {
                return $data;
            }
        }

        // Bewust leeg: bij de allereerste keer inloggen mag de wizard geen
        // voorbeeld-merkgegevens tonen — de klant vult alles zelf in.
        return [
            'site_name' => '',
            'colors'    => [],
            'logo'      => '',
            'favicon'   => '',
        ];
    }
}
