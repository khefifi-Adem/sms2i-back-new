<?php

namespace App\Http\Controllers;

use App\Models\Secteur;
use Illuminate\Http\Request;

class SecteurController extends Controller
{
    public function index()
    {
        return Secteur::all();
    }

    public function store (Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required'
        ]);
        return Secteur::create($request->all());
    }

    public function show($id)
    {
        return Secteur::find($id);
    }

    public function update (Request $request, $id)
    {
        $secteur = Secteur::find($id);
        $secteur->update($request->all());
        return $secteur;
    }

    public function destroy ($id)
    {
        return Secteur::destroy($id);
    }
}
