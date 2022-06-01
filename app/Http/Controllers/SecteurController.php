<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\Niveau;
use App\Models\Secteur;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SecteurController extends Controller
{
    public function index()
    {

        $secteur = Secteur::all();
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
        $secteur = Secteur::destroy($id);
        if ($secteur===1) {
            return response()->json([
                'status'=>200,
                'message' => 'deleted successfully'
            ]);
        }
    }




}
