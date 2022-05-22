<?php

namespace App\Http\Controllers;

use App\Models\Secteur;
use Illuminate\Http\Request;

class SecteurController extends Controller
{
    public function index()
    {
        $secteur = Secteur::with('domaine')->get();
        return response()->json([
            'status'=>200,
            'secteurs'=>$secteur
        ]);
    }

    public function store (Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required'
        ]);
        Secteur::create($request->all());
        return response()->json([
            'status'=> 200,
            'message' => 'Secteur created successfully'
        ]);
    }

    public function show($id)
    {
        return Secteur::find($id);
    }

    public function update (Request $request, $id)
    {
        $secteur = Secteur::find($id);
        $secteur->update($request->all());
        return response()->json([
            'status' => 200,
            'message' => "secteur updated successfully",
        ]);
    }

    public function destroy ($id)
    {
        return Secteur::destroy($id);
    }

}
