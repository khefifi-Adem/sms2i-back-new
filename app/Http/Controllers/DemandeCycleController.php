<?php

namespace App\Http\Controllers;

use App\Models\DemandeCycle;
use Illuminate\Http\Request;

class DemandeCycleController extends Controller
{
    public function index()
    {
        $demande = DemandeCycle::all();
        return response()->json([
            'status' => 200,
            'demands' => $demande
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'nb_personne' => 'required',
            'id_client_indus' => 'required',
            'id_niveau' => 'required'
        ]);
        DemandeCycle::create($request->all());
        return response()->json([
            'status'=> 200,
            'message' => 'demande received successfully'
        ]);
    }

        public function show($id)
    {
        return DemandeCycle::find($id);
    }

    public function update (Request $request, $id)
    {
        $demande = DemandeCycle::find($id);
        $demande->update($request->all());
        return $demande;
    }

    public function destroy ($id)
    {
        return DemandeCycle::destroy($id);
    }

}
