<?php

namespace App\Http\Controllers;

use App\Models\Bedrijf;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ZipArchive;

class ExportImportController extends Controller
{
    public function index()
    {
        $bedrijven   = Bedrijf::with('categorieen')->orderBy('naam')->get();
        $categorieen = Categorie::orderBy('categorie')->get();

        return view('admin.export_import', compact('bedrijven', 'categorieen'));
    }

    public function export(Request $request)
    {
        $bedrijfIds   = $request->input('bedrijf_ids', []);
        $categorieIds = $request->input('categorie_ids', []);

        $bedrijven = Bedrijf::with('categorieen')
            ->whereIn('id', $bedrijfIds)
            ->get()
            ->map(fn($b) => [
                'naam'              => $b->naam,
                'afbeelding'        => $b->afbeelding,
                'beschrijving_kort' => $b->beschrijving_kort,
                'beschrijving_lang' => $b->beschrijving_lang,
                'straat'            => $b->straat,
                'huisnummer'        => $b->huisnummer,
                'plaats'            => $b->plaats,
                'postcode'          => $b->postcode,
                'telefoon'          => $b->telefoon,
                'gsm'               => $b->gsm,
                'email'             => $b->email,
                'website'           => $b->website,
                'facebook'          => $b->facebook,
                'linkedin'          => $b->linkedin,
                'instagram'         => $b->instagram,
                'categorieen'       => $b->categorieen->pluck('categorie')->toArray(),
            ]);

        $categorieen = Categorie::whereIn('id', $categorieIds)
            ->orderBy('categorie')
            ->pluck('categorie');

        $data = [
            'export_version' => '2.0',
            'exported_at'    => now()->toDateTimeString(),
            'categorieen'    => $categorieen,
            'bedrijven'      => $bedrijven,
        ];

        $json     = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $filename = 'export_' . now()->format('Y-m-d_His');
        $zipPath  = sys_get_temp_dir() . '/' . $filename . '.zip';

        // Branding bestanden uitsluiten van export
        $brandingFile    = storage_path('app/branding.json');
        $branding        = file_exists($brandingFile) ? (json_decode(file_get_contents($brandingFile), true) ?? []) : [];
        $excludedImages  = array_filter([
            basename($branding['logo']         ?? config('branding.logo')),
            basename($branding['favicon']      ?? config('branding.favicon')),
            basename($branding['header_image'] ?? config('branding.header_image')),
        ]);

        $zip = new ZipArchive();
        $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $zip->addFromString('data.json', $json);

        // Voeg afbeeldingen toe, sla branding bestanden over
        foreach ($bedrijven as $b) {
            if (empty($b['afbeelding'])) continue;
            if (in_array(basename($b['afbeelding']), $excludedImages)) continue;
            $imagePath = public_path('images' . DIRECTORY_SEPARATOR . $b['afbeelding']);
            if (file_exists($imagePath)) {
                $zip->addFromString('images/' . basename($b['afbeelding']), file_get_contents($imagePath));
            }
        }

        $zip->close();

        return response()->download($zipPath, $filename . '.zip', [
            'Content-Type' => 'application/zip',
        ])->deleteFileAfterSend(true);
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:zip,json|max:51200',
        ]);

        $file = $request->file('import_file');

        // ZIP importeren
        if (strtolower($file->getClientOriginalExtension()) === 'zip') {
            $zip = new ZipArchive();

            if ($zip->open($file->getRealPath()) !== true) {
                return back()->with('import_error', 'ZIP bestand kon niet worden geopend.');
            }

            // Haal data.json op uit ZIP
            $json = $zip->getFromName('data.json');
            if ($json === false) {
                $zip->close();
                return back()->with('import_error', 'Geen data.json gevonden in het ZIP bestand.');
            }

            // Laad huidige branding om logo/favicon/header te beschermen
            $brandingFile    = storage_path('app/branding.json');
            $branding        = file_exists($brandingFile) ? (json_decode(file_get_contents($brandingFile), true) ?? []) : [];
            $protectedImages = array_filter([
                basename($branding['logo']         ?? config('branding.logo')),
                basename($branding['favicon']      ?? config('branding.favicon')),
                basename($branding['header_image'] ?? config('branding.header_image')),
            ]);

            // Kopieer afbeeldingen, sla branding bestanden over
            $imagesDir = public_path('images');
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $name     = $zip->getNameIndex($i);
                $basename = basename($name);
                if (!str_starts_with($name, 'images/') || strlen($name) <= 7) continue;
                if (in_array($basename, $protectedImages)) continue;
                $imageData = $zip->getFromIndex($i);
                $dest      = $imagesDir . '/' . $basename;
                if (!file_exists($dest)) {
                    file_put_contents($dest, $imageData);
                }
            }

            $zip->close();
        } else {
            // Gewone JSON (backwards compatible)
            $json = file_get_contents($file->getRealPath());
        }

        $data = json_decode($json, true);

        if (!$data || !isset($data['export_version'])) {
            return back()->with('import_error', 'Ongeldig bestandsformaat.');
        }

        $imported_categories = 0;
        $imported_bedrijven  = 0;

        foreach ($data['categorieen'] ?? [] as $naam) {
            Categorie::firstOrCreate(['categorie' => $naam]);
            $imported_categories++;
        }

        foreach ($data['bedrijven'] ?? [] as $b) {
            $bedrijf = Bedrijf::create([
                'naam'              => $b['naam']              ?? null,
                'afbeelding'        => $b['afbeelding']        ?? null,
                'beschrijving_kort' => $b['beschrijving_kort'] ?? null,
                'beschrijving_lang' => $b['beschrijving_lang'] ?? null,
                'straat'            => $b['straat']            ?? null,
                'huisnummer'        => $b['huisnummer']        ?? null,
                'plaats'            => $b['plaats']            ?? null,
                'postcode'          => $b['postcode']          ?? null,
                'telefoon'          => $b['telefoon']          ?? null,
                'gsm'               => $b['gsm']               ?? null,
                'email'             => $b['email']             ?? null,
                'website'           => $b['website']           ?? null,
                'facebook'          => $b['facebook']          ?? null,
                'linkedin'          => $b['linkedin']          ?? null,
                'instagram'         => $b['instagram']         ?? null,
            ]);

            $catIds = [];
            foreach ($b['categorieen'] ?? [] as $catNaam) {
                $cat      = Categorie::firstOrCreate(['categorie' => $catNaam]);
                $catIds[] = $cat->id;
            }
            $bedrijf->categorieen()->sync($catIds);

            $imported_bedrijven++;
        }

        return back()->with('import_success', "Import geslaagd: {$imported_bedrijven} bedrijven en {$imported_categories} categorieën geïmporteerd.");
    }

    public function clearBedrijven(Request $request)
    {
        $what = $request->input('what', 'bedrijven');

        if ($what === 'alles') {
            DB::table('bedrijf_categorie')->delete();
            Bedrijf::truncate();
            Categorie::truncate();
            return back()->with('import_success', 'Alle bedrijven én categorieën zijn verwijderd.');
        }

        DB::table('bedrijf_categorie')->delete();
        Bedrijf::truncate();
        return back()->with('import_success', 'Alle bedrijven zijn verwijderd. Categorieën zijn behouden.');
    }
}
