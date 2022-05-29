<?php

namespace App\Http\Controllers;

use App\Models\CycleFormation;
use App\Models\Inscription;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'inscriptions' => Inscription::all()
        ]);

    }

//    public function indexInscription($id)
//    {
//        $cycles = Inscription::where('id_user',$id)->get();
//        return response()->json([
//            'status' => 200,
//            'inscription' => $cycles
//        ]);
//    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cycle_formation' => 'required',
            'id_user' => 'required'
        ]);


        if (Inscription::find($request->id_user) && Inscription::find($request->id_cycle_formation))
        {
            return response()->json([
                'status' => 400,
                'message' => 'vous etes deja inscrit'
            ]);
        }else {

        Inscription::create($request->all());

        return response()->json([
           'status' => 200,
           'message' => 'vous etes inscrit'
        ]);}
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
