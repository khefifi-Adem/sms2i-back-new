<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['user','societe'])->get();;
        return response()->json([
            'status'=>200,
            'projects'=>$projects
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
            'id_soc'=>'required',
            'id_client_indus' => 'required',
            'id_domaine_indus' => 'required'
        ]);


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('uploads/projects/');
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
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('uploads/projects/');
            $image->move($destinationPath, $image_name);
            $project->title = $request->title;
            $project->description = $request->description;
            $project->image = 'uploads/projects/'.$image_name ;
            $project->id_soc = $request->id_soc ;
            $project->id_client_indus = $request->id_client_indus ;
            $project->id_domaine_indus = $request->id_domaine_indus;

            $project->update();
            return response()->json([
                'status' => 200,
                'message' => 'project updated perfectly'
            ]);

        }

    }

    public function destroy ($id)
    {
        return Project::destroy($id);
    }
}
