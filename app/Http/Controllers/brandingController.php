<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class brandingController extends Controller
{
    private string $storagePath;

    // Beschikbare Google Fonts
    private array $googleFonts = [
        'Arial'       => null,
        'Inter'       => 'https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap',
        'Roboto'      => 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap',
        'Poppins'     => 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap',
        'Lato'        => 'https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap',
        'Open Sans'   => 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap',
        'Montserrat'  => 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap',
    ];

    public function __construct()
    {
        $this->storagePath = storage_path('app/branding.json');
    }

    public function index()
    {
        $settings   = $this->loadSettings();
        $fonts      = array_keys($this->googleFonts);
        $images     = $this->getAvailableImages();
        return view('admin.branding', compact('settings', 'fonts', 'images'));
    }

    public function update(Request $request)
    {
        $settings = $this->loadSettings();

        // Algemeen
        $settings['site_name'] = $request->input('site_name', $settings['site_name'] ?? config('branding.site_name'));
        $settings['site_desc'] = $request->input('site_desc', $settings['site_desc'] ?? config('branding.site_desc'));

        // Favicon uploaden
        if ($request->hasFile('favicon')) {
            $file     = $request->file('favicon');
            $filename = 'favicon.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $settings['favicon'] = '/images/' . $filename;

            // Overschrijf ook public/favicon.ico zodat browsers de nieuwe favicon pakken
            copy(public_path('images/' . $filename), public_path('favicon.ico'));
        }

        // Kleuren opslaan (hover automatisch 20% donkerder)
        $primary = $request->input('primary_color', $settings['colors']['primary'] ?? config('branding.colors.primary'));
        $accent  = $request->input('accent_color',  $settings['colors']['accent']  ?? config('branding.colors.accent'));

        $settings['colors']['primary']       = $primary;
        $settings['colors']['primary_hover'] = $this->darkenColor($primary);
        $settings['colors']['accent']        = $accent;
        $settings['colors']['accent_hover']  = $this->darkenColor($accent);
        $settings['colors']['header_bg']     = $request->input('header_bg',    $settings['colors']['header_bg']    ?? config('branding.colors.header_bg'));
        $settings['colors']['header_text']   = $request->input('header_text',  $settings['colors']['header_text']  ?? config('branding.colors.header_text'));
        $settings['colors']['footer_bg']     = $request->input('footer_bg',    $settings['colors']['footer_bg']    ?? config('branding.colors.footer_bg'));
        $settings['colors']['cta_bg']        = $request->input('cta_bg',       $settings['colors']['cta_bg']       ?? config('branding.colors.cta_bg'));
        $settings['colors']['cta_text']      = $request->input('cta_text',     $settings['colors']['cta_text']     ?? '#ffffff');
        $settings['colors']['cta_btn_bg']    = $request->input('cta_btn_bg',   $settings['colors']['cta_btn_bg']   ?? config('branding.colors.cta_btn_bg'));
        $settings['colors']['cta_btn_text']  = $request->input('cta_btn_text', $settings['colors']['cta_btn_text'] ?? config('branding.colors.cta_btn_text'));

        // Font opslaan
        $fontKey = $request->input('font_family', 'Arial');
        $settings['fonts']['family'] = $fontKey === 'Arial'
            ? 'Arial, Helvetica, sans-serif'
            : $fontKey . ', sans-serif';
        $settings['fonts']['google'] = $this->googleFonts[$fontKey] ?? null;

        // Logo: bestaande afbeelding kiezen of uploaden
        if ($request->filled('logo_existing')) {
            $settings['logo'] = $request->input('logo_existing');
        }
        if ($request->hasFile('logo')) {
            $file     = $request->file('logo');
            $filename = 'logo.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $settings['logo'] = '/images/' . $filename;
        }

        // Footer logo: apart logo voor in de footer
        if ($request->filled('footer_logo_existing')) {
            $settings['footer_logo'] = $request->input('footer_logo_existing');
        }
        if ($request->hasFile('footer_logo')) {
            $file     = $request->file('footer_logo');
            $filename = 'footer_logo.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $settings['footer_logo'] = '/images/' . $filename;
        }

        // Header afbeelding: bestaande kiezen of uploaden
        if ($request->filled('header_image_existing')) {
            $settings['header_image'] = $request->input('header_image_existing');
        }
        if ($request->hasFile('header_image')) {
            $file     = $request->file('header_image');
            $filename = 'header_image.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $settings['header_image'] = '/images/' . $filename;
        }

        // Template
        $template = $request->input('template', 'modern');
        if (!in_array($template, ['modern', 'minimal', 'warm', 'corporate', 'dark', 'retro', 'helder', 'snel'])) {
            $template = 'modern';
        }
        $settings['template'] = $template;

        file_put_contents($this->storagePath, json_encode($settings, JSON_PRETTY_PRINT));

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Stijl opgeslagen!']);
        }
        return redirect()->route('admin.branding')->with('success', 'Huisstijl opgeslagen!');
    }

    // Laad instellingen uit JSON, met fallback naar config/branding.php
    private function loadSettings(): array
    {
        if (file_exists($this->storagePath)) {
            $data = json_decode(file_get_contents($this->storagePath), true);
            if (is_array($data)) {
                return $data;
            }
        }

        return [
            'site_name'    => config('branding.site_name'),
            'site_desc'    => config('branding.site_desc'),
            'favicon'      => config('branding.favicon'),
            'logo'         => config('branding.logo'),
            'footer_logo'  => config('branding.footer_logo'),
            'header_image' => config('branding.header_image'),
            'colors'       => config('branding.colors'),
            'fonts'        => config('branding.fonts'),
            'template'     => config('branding.template'),
        ];
    }

    // Haal alle afbeeldingen op uit public/images
    private function getAvailableImages(): array
    {
        $dir = public_path('images');
        $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
        $images = [];
        foreach (glob($dir . '/*') as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($ext, $extensions)) {
                $images[] = '/images/' . basename($file);
            }
        }
        sort($images);
        return $images;
    }

    // Verdonker een hex-kleur met 20%
    private function darkenColor(string $hex): string
    {
        $hex = ltrim($hex, '#');
        $r   = (int)(hexdec(substr($hex, 0, 2)) * 0.8);
        $g   = (int)(hexdec(substr($hex, 2, 2)) * 0.8);
        $b   = (int)(hexdec(substr($hex, 4, 2)) * 0.8);
        return sprintf('#%02x%02x%02x', $r, $g, $b);
    }
}
