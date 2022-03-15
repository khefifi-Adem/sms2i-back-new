<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        return Theme::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'domaine_id' => 'required'
        ]);
        return Theme::create($request->all());
    }

    public function show($id)
    {
        return Theme::find($id);
    }

    public function update (Request $request, $id)
    {
        $theme = Theme::find($id);
        $theme->update($request->all());
        return $theme;
    }

    public function destroy ($id)
    {
        return Theme::destroy($id);
    }
}