<?php

namespace App\Http\Controllers;

use App\Models\ProgrammeFile;
use Illuminate\Http\Request;

class ProgrammeFileController extends Controller
{
    public function index()
    {
        $files = ProgrammeFile::all();
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
            $destinationPath = base_path('uploads/files/');
            $file->move($destinationPath, $file_name);
            $file = new ProgrammeFile([
                'id_cycle' => $request->id_cycle,
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
            'file' => ProgrammeFile::find($id)
        ]);
    }

    public function update (Request $request, $id)
    {
        $file = ProgrammeFile::find($id);
        $file->update($request->all());
        return response()->json([
            'status'=> 200,
            'message' => 'file updated'
        ]);
    }

    public function destroy ($id)
    {
        return ProgrammeFile::destroy($id);
    }
}
