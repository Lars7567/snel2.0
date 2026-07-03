<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bedrijf;
use App\Models\Categorie;

class bedrijvenController extends Controller
{
    private function buildQuery(string $sort, string $zoek, ?int $categorieId)
    {
        $q = Bedrijf::query();

        if ($zoek) {
            $q->where(function ($query) use ($zoek) {
                $query->where('naam', 'like', "%{$zoek}%")
                      ->orWhere('beschrijving_kort', 'like', "%{$zoek}%")
                      ->orWhere('plaats', 'like', "%{$zoek}%");
            });
        }

        if ($categorieId) {
            $q->whereHas('categorieen', fn($query) => $query->where('categorie.id', $categorieId));
        }

        match($sort) {
            'naam_desc'   => $q->orderBy('naam', 'desc'),
            'naam_asc'    => $q->orderBy('naam', 'asc'),
            'nieuwste'    => $q->orderBy('created_at', 'desc'),
            default       => $q->orderBy('clicks', 'desc'),
        };

        return $q;
    }

    public function index()
    {
        $categorieen = Categorie::orderBy('categorie')->get();
        $bedrijven   = $this->buildQuery('clicks_desc', '', null)->take(9)->get();
        $totaal      = Bedrijf::count();
        return view('bedrijven.index', compact('bedrijven', 'categorieen', 'totaal'));
    }

    public function meer(Request $request)
    {
        $offset      = (int) $request->input('offset', 0);
        $sort        = (string) $request->input('sort', 'clicks_desc');
        $zoek        = trim((string) $request->input('zoek', ''));
        $categorieId = $request->input('categorie') ? (int) $request->input('categorie') : null;
        $limit       = 9;

        $query  = $this->buildQuery($sort, $zoek, $categorieId);
        $totaal = $query->count();

        $bedrijven = $query->skip($offset)->take($limit)->get()->map(fn($b) => [
            'id'                => $b->id,
            'naam'              => $b->naam,
            'plaats'            => $b->plaats,
            'beschrijving_kort' => $b->beschrijving_kort,
            'afbeelding'        => $b->afbeelding,
        ]);

        return response()->json([
            'bedrijven' => $bedrijven,
            'heeftMeer' => ($offset + $limit) < $totaal,
            'totaal'    => $totaal,
        ]);
    }

    public function show(int $id)
    {
        return view('bedrijven.show', compact('id'));
    }
}
