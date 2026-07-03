<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BedrijfRequest;
use App\Http\Requests\categorieRequest;
use App\Models\Bedrijf;
use App\Models\Categorie;

class adminController extends Controller
{
    public function index()
    {
        $bedrijven = Bedrijf::orderBy('naam')->get();
        $categorieen = Categorie::orderBy('categorie')->get();

        return view('admin.index', compact('bedrijven', 'categorieen'));
    }

    public function create()
    {
        $categorieen = Categorie::all();

        return view('admin.create', compact('categorieen'));
    }

    // show a form to add a new category (no id required)
    public function newCategorie()
    {
        return view('admin.categorie_create');
    }

    public function store(BedrijfRequest $request)
    {
        $data = $request->validated();
        $categorieIds = $data['categorie_ids'];
        unset($data['categorie_ids']);

        if ($request->hasFile('afbeelding')) {
            $file = $request->file('afbeelding');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['afbeelding'] = $filename;
        }

        $bedrijf = Bedrijf::create($data);
        $bedrijf->categorieen()->sync($categorieIds);

        if ($request->input('action') === 'save_new') {
            return redirect()->route('admin.create')
                ->with('success', 'Bedrijf aangemaakt! Voeg nog een toe.');
        }

        return redirect()->route('admin.index')
            ->with('success', 'Bedrijf succesvol aangemaakt!');
    }

    public function show($plaats)
    {
        $categorieen = Categorie::all();
        $bedrijven = Bedrijf::where('plaats', $plaats)->get();

        return view('admin.plaats', compact('plaats', 'bedrijven', 'categorieen'));
    }

    public function showCategorie($id)
    {
        $categorie = Categorie::findOrFail($id);
        $bedrijven = $categorie->bedrijven;

        return view('admin.categorie_show', compact('categorie', 'bedrijven'));
    }

    public function createCategorie($id)
    {
        $categorie = Categorie::findOrFail($id);
        $bedrijven = $categorie->bedrijven;

        return view('admin.categorie_create', compact('categorie', 'bedrijven'));
    }

    public function storeCategorie(Request $request)
    {
        $request->validate([
            'categorie' => 'required|string|max:255',
        ]);

        Categorie::create([
            'categorie' => $request->input('categorie'),
        ]);

        if ($request->input('action') === 'save_new') {
            return redirect()->route('admin.newCategorie')
                ->with('success', 'Categorie aangemaakt! Voeg nog een toe.');
        }

        return redirect()->route('admin.index')
            ->with('success', 'Categorie succesvol aangemaakt!');
    }

    public function edit($id)
    {
        $bedrijf = Bedrijf::findOrFail($id);
        $categorieen = Categorie::all();
        return view('admin.edit', compact('bedrijf', 'categorieen'));
    }

    public function editCategorie($id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('admin.categorie_edit', compact('categorie'));
    }

    public function update(BedrijfRequest $request, $id)
    {
        $bedrijf = Bedrijf::findOrFail($id);
        $data = $request->validated();
        $categorieIds = $data['categorie_ids'];
        unset($data['categorie_ids']);

        if ($request->hasFile('afbeelding')) {
            $file = $request->file('afbeelding');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['afbeelding'] = $filename;
        }

        $bedrijf->update($data);
        $bedrijf->categorieen()->sync($categorieIds);

        if ($request->input('from_plaats') && $bedrijf->plaats) {
            return redirect()->route('admin.show', $bedrijf->plaats)
                ->with('success', 'Bedrijf succesvol bijgewerkt!');
        }

        return redirect()->route('admin.index')
            ->with('success', 'Bedrijf succesvol bijgewerkt!');
    }

    public function updateCategorie(categorieRequest $request, $id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->update([
            'categorie' => $request->input('categorie'),
        ]);

        return redirect()->route('admin.index')
            ->with('success', 'Categorie succesvol bijgewerkt!');
    }

    public function destroy(Request $request, $id)
    {
        $bedrijf = Bedrijf::findOrFail($id);
        $plaats  = $bedrijf->plaats;
        $bedrijf->delete();

        if ($request->input('from_plaats') && $plaats) {
            return redirect()->route('admin.show', $plaats)
                ->with('success', 'Bedrijf succesvol verwijderd!');
        }

        return redirect()->route('admin.index')
            ->with('success', 'Bedrijf succesvol verwijderd!');
    }

    public function destroyCategorie($id)
    {
        $categorie = Categorie::findOrFail($id);

        if ($categorie->bedrijven()->exists()) {
            return redirect()->route('admin.showCategorie', $id)
                ->with('error', 'Verwijder eerst alle bedrijven uit deze categorie.');
        }

        $categorie->delete();

        return redirect()->route('admin.index')
            ->with('success', 'Categorie succesvol verwijderd!');
    }

    private function save($bedrijf, BedrijfRequest $request)
    {
        $validated = $request->validated();
        $bedrijf->fill($validated);
        $bedrijf->save();
    }
}
