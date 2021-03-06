<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\Http\Request;

class NiveauController extends Controller
{
    public function index()
    {
        $niveaux = Niveau::all();
        return response()->json([
            'status' => 200,
            'niveaux' => $niveaux
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'file_path' => 'required|file|mimes:pdf',
            'theme_id' => 'required'
        ]);

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = base_path('public/uploads/files/niveaux/');
            $file->move($destinationPath, $file_name);
            $niveau = new Niveau([
                'titre' => $request->titre,
                'description' => $request->description,
                'file_path' => 'uploads/files/niveaux/'.$file_name ,
                'theme_id' => $request->theme_id
            ]);
            $niveau->save();
            return response()->json([
                'status' => 200,
                'message' => 'niveau added perfectly'
            ]);

        }
        else
        {
            return response()->json([
                'status' => 400,
                'message' => 'creation totally failed'
            ]);

        }




    }

    public function show($id)
    {
        return Niveau::find($id);
    }

    public function update (Request $request, $id)
    {
        $niveau = Niveau::find($id);
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = base_path('public/uploads/files/niveaux/');
            $file->move($destinationPath, $file_name);

                $niveau->titre = $request->titre;
                $niveau->description = $request->description;
                $niveau->file_path = 'uploads/files/niveaux/'.$file_name;

            $niveau->update();
            return response()->json([
                'status' => 200,
                'message' => 'niveau updated perfectly'
            ]);

        }

    }

    public function destroy ($id)
    {
        Niveau::destroy($id);
        return response()->json([
            'status' => 200,
            'message' => 'niveau deleted perfectly'
        ]);
    }



    public function indexNiveau($id)
    {
        $niveaux = Niveau::where('theme_id',$id)->get();
        return response()->json([
            'status' => 200,
            'niveaux' => $niveaux,
        ]);
    }
}
