<?php

namespace App\Http\Controllers;

use App\Models\Bedrijf;
use App\Models\Categorie;

class homeController extends Controller
{
    public function index()
    {
        $topBedrijven = Bedrijf::orderBy('clicks', 'desc')->take(9)->get();
        $totaal = Bedrijf::count();
        $nieuwBedrijven = Bedrijf::orderBy('created_at', 'desc')->take(6)->get();
        $categorieën = Categorie::withCount('bedrijven')->whereHas('bedrijven')->get()->sortByDesc('bedrijven_count');
        return view('home.index', compact('topBedrijven', 'totaal', 'nieuwBedrijven', 'categorieën'));
    }

    public function meer()
    {
        $offset = (int) request('offset', 9);
        $limit  = 9;

        $bedrijven = Bedrijf::orderBy('clicks', 'desc')
            ->skip($offset)
            ->take($limit)
            ->get()
            ->map(fn($b) => [
                'id'               => $b->id,
                'naam'             => $b->naam,
                'plaats'           => $b->plaats,
                'beschrijving_kort'=> $b->beschrijving_kort,
                'afbeelding'       => $b->afbeelding,
            ]);

        $totaal = Bedrijf::count();

        return response()->json([
            'bedrijven' => $bedrijven,
            'heeftMeer' => ($offset + $limit) < $totaal,
        ]);
    }

    public function show($id)
    {
        $bedrijven = Bedrijf::findOrFail($id);
        // Increment the clicks counter when bedrijf is viewed
        $bedrijven->increment('clicks');
        return view('home.show', compact('bedrijven'));
    }
}
