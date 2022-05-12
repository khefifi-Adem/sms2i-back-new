<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use Illuminate\Http\Request;

class DomaineController extends Controller
{
    public function index()
    {
        $domaines = Domaine::with('theme')->get();
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
        return Domaine::create($request->all());
    }

    public function show($id)
    {
        return Domaine::find($id);
    }

    public function update (Request $request, $id)
    {
        $domaine = Domaine::find($id);
        $domaine->update($request->all());
        return $domaine;
    }

    public function destroy ($id)
    {
        return Domaine::destroy($id);
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
