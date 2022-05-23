<?php

namespace App\Http\Controllers;

use App\Models\CycleFormationIndus;
use Illuminate\Http\Request;

class CycleFormationIndusController extends Controller
{
    public function index()
    {
        $cycle = CycleFormationIndus::all();
        return response()->json([
            'status' => 200,
            'cycles' => $cycle
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'description' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required',
            'nb_jours' => 'required',
            'nb_heures' => 'required',
            'nb_places_dispo' => 'required',
            'id_formateur' => 'required',
            'id_user' => 'required',
            'niveau_id' => 'required',
            'cout' => 'required',
            'etat' => 'required'
        ]);
        CycleFormationIndus::create($request->all());
        return response()->json([
            'status'=> 200,
            'message' => 'Cycle created successfully'
        ]);
    }

    public function show($id)
    {
        return CycleFormationIndus::find($id);
    }

    public function update (Request $request, $id)
    {
        $cycle = CycleFormationIndus::find($id);
        $cycle->update($request->all());
        return $cycle;
    }

    public function destroy ($id)
    {
        return CycleFormationIndus::destroy($id);
    }
}
