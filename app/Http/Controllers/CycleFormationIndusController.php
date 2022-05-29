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
            'titre' => 'required',
            'description' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required',
            'nb_jours' => 'required',
            'nb_heures' => 'required',
            'nb_places' => 'required',
            'id_formateur' => 'required',
            'id_user' => 'required',
            'niveau_id' => 'required',
            'cout' => 'required',
            'link' => 'required',

        ]);
        $cycle = new CycleFormationIndus (
            [
                'titre' => $request->titre,
                'description' => $request->description,
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_fin,
                'nb_jours' => $request->nb_jours,
                'nb_heures' => $request->nb_heures,
                'nb_places' => $request->nb_places,
                'id_formateur' => $request->id_formateur,
                'id_user'=> $request->id_user,
                'niveau_id' => $request->niveau_id,
                'cout' => $request->cout,
                'link' => $request->link,
            ]
        );
        $cycle->save();

        return response()->json([
            'status'=> 200,
            'message' => 'Cycle created successfully',
            'cycle' => $cycle
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
