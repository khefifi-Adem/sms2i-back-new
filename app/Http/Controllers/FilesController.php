<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function index()
    {
        $files = Files::all();
        return response()->json([
            'status' => 200,
            'files' => $files,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_path' => 'required|file|mimes:pdf'
        ]);

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = base_path('public/uploads/files/');
            $file->move($destinationPath, $file_name);
            $file = new Files([
                'titre' => $request->titre,
                'id_cycle' => $request->id_cycle,
                'file_path' => 'uploads/files/'.$file_name ,
            ]);
            $file->save();
            return response()->json([
                'status' => 200,
                'message' => 'file added perfectly'
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
    public function storeIndus(Request $request)
    {
        $request->validate([
            'file_path' => 'required|file|mimes:pdf'
        ]);

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $file_name = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = base_path('public/uploads/files/');
            $file->move($destinationPath, $file_name);
            $file = new Files([
                'titre' => $request->titre,
                'id_induses' => $request->id_induses,
                'file_path' => 'uploads/files/'.$file_name ,
            ]);
            $file->save();
            return response()->json([
                'status' => 200,
                'message' => 'file added perfectly'
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
        return response()->json([
            'status' => 200,
            'file' => Files::find($id)
        ]);
    }

    public function update (Request $request, $id)
    {
        $file = Files::find($id);
        if ($request->hasFile('file_path')) {
            $files = $request->file('file_path');
            $file_name = time() . '.' . $files->getClientOriginalExtension();
            $destinationPath = base_path('public/uploads/files/');
            $files->move($destinationPath, $file_name);
            $files->file_path = $request->file_path;

            $file->titre =  $request->titre;
            $file->file_path = 'uploads/files/'.$file_name;


            $file->update();

            return response()->json([
                'status' => 200,
                'message' => 'file updated'
            ]);
        }else {
            $file->update($request->all());
            return response()->json([
                'status' => 200,
                'message' => 'file updated'
            ]);
        }
    }

    public function destroy ($id)
    {
        Files::destroy($id);
        return response()->json([
           'status'=> 200,
           'message' => 'deleted successfully'
        ]);
    }
}
