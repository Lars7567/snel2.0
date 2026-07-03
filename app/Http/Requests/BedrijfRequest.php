<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BedrijfRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'naam'              => 'nullable|string|max:255',
            'afbeelding'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'beschrijving_kort' => 'nullable|string|max:255',
            'beschrijving_lang' => 'nullable|string|max:10000',
            'straat'            => 'nullable|string|max:255',
            'huisnummer'        => 'nullable|string|max:10',
            'plaats'            => 'nullable|string|max:255',
            'postcode'          => 'nullable|string|max:10',
            'telefoon'          => 'nullable|string|max:20',
            'gsm'               => 'nullable|string|max:20',
            'email'             => 'nullable|email|max:255',
            'website'           => 'nullable|url|max:255',
            'facebook'          => 'nullable|url|max:255',
            'linkedin'          => 'nullable|url|max:255',
            'instagram'         => 'nullable|url|max:255',
            'categorie_ids'     => 'required|array|min:1',
            'categorie_ids.*'   => 'integer|exists:categorie,id',
        ];
    }

    public function messages(): array
    {
        return [
            'categorie_ids.required' => 'Selecteer minimaal één categorie.',
            'categorie_ids.min'      => 'Selecteer minimaal één categorie.',
        ];
    }
}