<?php

namespace App\Http\Controllers;

use App\Models\CycleFormation;
use Illuminate\Http\Request;

class CycleFormationController extends Controller
{
    public function index()
    {
        return CycleFormation::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'date_debut' => 'required|after:today',
            'date_fin' => 'required|after:date_debut',
            'nb_jours' => 'required',
            'nb_heures' => 'required',
            'nb_places' => 'required',
            'nb_places_dispo' => 'required',
            'niveau_id' => 'required',

            'etat' => 'required'
        ]);
        return CycleFormation::create($request->all());
    }

    public function show($id)
    {
        return CycleFormation::find($id);
    }

    public function update (Request $request, $id)
    {
        $cycle_formation = CycleFormation::find($id);
        $cycle_formation->update($request->all());
        return $cycle_formation;
    }


    public function destroy ($id)
    {
        return CycleFormation::destroy($id);
    }
}
