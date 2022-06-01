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

        Inscription::create($request->all());

            return response()->json([
                'status' => 200,
                'message' => 'vous etes inscrit'
            ]);
        }



    public function show($id)
    {
        return Inscription::find($id);
    }

    public function indexInscription($id)
    {
        $inscritption = Inscription::where('id_user',$id)->get();
        return response()->json([
           'status' => 200,
           'inscriptions' => $inscritption
        ]);
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
