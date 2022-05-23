<?php

namespace App\Http\Controllers;

use App\Models\CycleFormation;
use Illuminate\Http\Request;

class CycleFormationController extends Controller
{
    public function index()
    {
        $cycle= CycleFormation::all();
        return response()->json([
            'status'=> 200,
            'cycles' => $cycle
        ]);
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
            'formateur_id' => 'required',
            'niveau_id' => 'required',
            'etat' => 'required'
        ]);
        $cycle = new CycleFormation (
            [
                'titre' => $request->titre,
                'description' => $request->description,
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_fin,
                'nb_jours' => $request->nb_jours,
                'nb_heures' => $request->nb_heures,
                'nb_places' => $request->nb_places,
                'nb_places_dispo' => $request->nb_places,
                'formateur_id' => $request->formateur_id,
                'niveau_id' => $request->niveau_id,
                'etat' => $request->etat
            ]
        );
        $cycle->save();

        return response()->json([
            'status' => 200,
            'message' => "cycle added successfully",
            'cycle' => $cycle
        ]);
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
