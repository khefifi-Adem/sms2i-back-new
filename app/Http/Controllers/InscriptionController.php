<?php

namespace App\Http\Controllers;

use App\Models\CycleFormation;
use App\Models\Inscription;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function index()
    {
        return Inscription::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cycle_formation' => 'required',
            'id_user' => 'required',
            'cout' => 'required'
        ]);


        return Inscription::create($request->all());
    }

    public function show($id)
    {
        return Inscription::find($id);
    }

    public function update (Request $request, $id)
    {
        $cycle_formation = Inscription::find($id);
        $cycle_formation->update($request->all());
        return $cycle_formation;
    }

    public function destroy ($id)
    {
        return Inscription::destroy($id);
    }
}
