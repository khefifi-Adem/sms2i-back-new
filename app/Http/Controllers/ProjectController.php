<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
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
            $destinationPath = base_path('public/uploads/projects/');
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

    public function showClientsProject($id)
    {
        $project = Project::where('id_client_indus',$id)->get();
        return response()->json([
            'status' => 200,
            'projects' => $project
        ]);
    }

    public function update (Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
            'id_soc'=>'required',
            'id_client_indus' => 'required',
            'id_domaine_indus' => 'required'
        ]);
        $project = Project::find($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('public/uploads/projects/');
            $image->move($destinationPath, $image_name);
            $project->title = $request->title;
            $project->description = $request->description;
            $project->image = 'uploads/projects/'.$image_name ;
            $project->id_soc = $request->id_soc ;
            $project->id_client_indus = $request->id_client_indus ;
            $project->id_domaine_indus = $request->id_domaine_indus;

            $project->save();
            return response()->json([
                'status' => 200,
                'message' => 'project updated perfectly'
            ]);

        }

    }

    public function destroy ($id)
    {
        Project::destroy($id);
        return response()->json([
            'status' => 200,
            'message' => 'project deleted perfectly'
        ]);
    }
}
