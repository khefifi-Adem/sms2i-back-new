<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use Illuminate\Http\Request;

class DomaineController extends Controller
{
    public function index()
    {
        return Domaine::all();
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
}
