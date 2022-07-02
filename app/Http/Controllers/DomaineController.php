<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use Illuminate\Http\Request;

class DomaineController extends Controller
{
    public function index()
    {
        $domaines = Domaine::all();
        return response()->json([
            'status'=>200,
            'domaines'=>$domaines
        ]);
    }

    public function indexSecteur($id)
    {
        $domaines = Domaine::where('secteur_id',$id)->with('theme')->get();
        return response()->json([
            'status'=>200,
            'domaines'=>$domaines
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'secteur_id' => 'required'
        ]);
        Domaine::create($request->all());

        return response()->json([
            'status'=> 200,
            'message' => 'Domain created successfully'
        ]);
    }

    public function show($id)
    {
        return Domaine::find($id);
    }

    public function update (Request $request, $id)
    {
        $domaine = Domaine::find($id);
        $domaine->update($request->all());
        return response()->json([
            'status' => 200,
            'message' => "domain updated successfully",
        ]);
    }

    public function destroy ($id)
    {
      Domaine::destroy($id);
        return response()->json([
            'status' => 200,
            'message' => "domain deleted successfully",
        ]);
    }

    public function indexDomaine($id)
    {
        $domaine = Domaine::where('secteur_id',$id)->get();
        return response()->json([
            'status' => 200,
            'domaines' => $domaine,
        ]);
    }
}
