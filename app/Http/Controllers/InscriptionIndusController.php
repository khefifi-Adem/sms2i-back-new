<?php

namespace App\Http\Controllers;

use App\Models\InscriptionIndus;
use Illuminate\Http\Request;

class InscriptionIndusController extends Controller
{
    public function index()
    {
        return InscriptionIndus::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cycle_formation' => 'required',
            'id_user' => 'required',
            'nb_personnel' => 'required',
            'cout' => 'required'
        ]);


        return InscriptionIndus::create($request->all());
    }

    public function show($id)
    {
        return InscriptionIndus::find($id);
    }

    public function update (Request $request, $id)
    {
        $cycle_formation = InscriptionIndus::find($id);
        $cycle_formation->update($request->all());
        return $cycle_formation;
    }

    public function destroy ($id)
    {
        return InscriptionIndus::destroy($id);
    }
}
