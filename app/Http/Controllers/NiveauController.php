<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\Http\Request;

class NiveauController extends Controller
{
    public function index()
    {
        return Niveau::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'theme_id' => 'required'
        ]);
        return Niveau::create($request->all());
    }

    public function show($id)
    {
        return Niveau::find($id);
    }

    public function update (Request $request, $id)
    {
        $niveau = Niveau::find($id);
        $niveau->update($request->all());
        return $niveau;
    }

    public function destroy ($id)
    {
        return Niveau::destroy($id);
    }
}
