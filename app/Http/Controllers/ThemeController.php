<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::with('niveau')->get();
        return response()->json([
            'status'=>200,
            'themes'=>$themes
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'domaine_id' => 'required'
        ]);
        Theme::create($request->all());
        return response()->json([
            'status'=>200,
            'message'=> 'theme created successfully'
        ]);
    }

    public function show($id)
    {
        return Theme::find($id);
    }

    public function update (Request $request, $id)
    {
        $theme = Theme::find($id);
        $theme->update($request->all());
        return response()->json([
            'status' => 200,
            'message' => "theme updated successfully",
        ]);
    }

    public function destroy ($id)
    {
        Theme::destroy($id);
        return response()->json([
            'status' => 200,
            'message' => "theme deleted successfully",
        ]);
    }

    public function indexTheme($id)
    {
        $themes = Theme::where('domaine_id',$id)->get();
        return response()->json([
            'status' => 200,
            'themes' => $themes,
        ]);
    }
}
