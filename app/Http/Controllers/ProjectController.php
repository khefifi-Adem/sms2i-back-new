<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $project = Project::all();
        return response()->json([
            'status'=>200,
            'project'=>$project
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'article' => 'required',
            'description' => 'required',
            'id_marque'=>'required',
            'id_categorie_utilisation'=>'required',
            'image_alt' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);


        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('uploads/articles/');
            $image->move($destinationPath, $image_name);
            $project = new Project([
                'title' => $request->title,
                'description' => $request->description,
                'image' => 'uploads/projects/'.$image_name ,
                'id_soc' => $request->id_soc ,
                'id_client_indus' => $request->id_client_indus ,
                'id_domaine_indus' => $request->id_domaine_indus
            ]);
            $project->save();
            return response()->json([
                'status' => 200,
                'message' => 'project added perfectly'
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
        return Project::find($id);
    }

    public function update (Request $request, $id)
    {
        $project = Project::find($id);
        $project->update($request->all());
        return $project;
    }

    public function destroy ($id)
    {
        return Project::destroy($id);
    }
}
