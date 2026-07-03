<?php

namespace App\Http\Controllers;

use App\Models\Bevestiging;
use Illuminate\Http\Request;

class BevestigingController extends Controller
{
    public function index()
    {
        $bevestigingen = Bevestiging::orderByDesc('created_at')->get();
        return view('admin.bevestigingen.index', compact('bevestigingen'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['data' => 'required|array']);
        $titel = $data['data']['kBedrijf'] ?? 'Onbekend';

        $bevestiging = Bevestiging::create([
            'titel' => $titel,
            'data'  => $data['data'],
        ]);

        return response()->json(['id' => $bevestiging->id, 'titel' => $bevestiging->titel]);
    }

    public function show(Bevestiging $bevestiging)
    {
        return response()->json($bevestiging);
    }

    public function update(Request $request, Bevestiging $bevestiging)
    {
        $data = $request->validate(['data' => 'required|array']);

        $bevestiging->update([
            'titel' => $data['data']['kBedrijf'] ?? 'Onbekend',
            'data'  => $data['data'],
        ]);

        return response()->json(['id' => $bevestiging->id, 'titel' => $bevestiging->titel]);
    }

    public function destroy(Bevestiging $bevestiging)
    {
        $bevestiging->delete();
        return response()->json(['ok' => true]);
    }
}
