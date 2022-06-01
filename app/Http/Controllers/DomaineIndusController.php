<?php

namespace App\Http\Controllers;

use App\Models\Domaine_indus;
use Illuminate\Http\Request;

class DomaineIndusController extends Controller
{
    public function index()
    {
        $domaineindus = Domaine_indus::with('projects')->get();;
        return response()->json([
            'status' => 200,
            'domaineindus' => $domaineindus,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
        ]);
        Domaine_indus::create($request->all());
        return response()->json([
            'status'=> 200,
            'message' => 'domaine insutriel created successfully'
        ]);
    }

    public function show($id)
    {
        return Domaine_indus::find($id);
    }

    public function update (Request $request, $id)
    {
        $domaineindus = Domaine_indus::find($id);
        $domaineindus->update($request->all());
        return response()->json([
            'status'=> 200,
            'message' => 'domaine industriel updated successfully'
        ]);
    }

    public function destroy ($id)
    {
        Domaine_indus::destroy($id);

        return response()->json([
            'status'=> 200,
            'message' => 'domaine industriel deletes successfully'
        ]);
    }
}
