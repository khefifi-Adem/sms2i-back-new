<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    public function index()
    {

        $service = Service::all();
        return response()->json([
            'status' => 200,
            'services' => $service
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:4096'
        ]);


        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('public/uploads/service/');
            $image->move($destinationPath, $image_name);
            $services = new Service([
                'titre' => $request->titre,
                'description' => $request->description,
                'image_path' => 'uploads/service/'.$image_name,
            ]);
            $services->save();

            return response()->json([
                'status' => 200,
                'message' => "service seccessfully added",
            ]);

        }
        else
        {
            return response ('mession failed',400);
        }
    }

    public function show($id)
    {
        return Service::find($id);
    }

    public function update (Request $request, $id)
    {
        $service = Service::find($id);

        if ($request->hasFile('image_path')) {
            if (File::exists($service->image_path)){
                File::delete($service->image_path);
            }
            $image = $request->file('image_path');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = base_path('public/uploads/service/');
            $image->move($destinationPath, $image_name);


            $service->titre = $request->titre;
            $service->description = $request->description;
            $service->image_path = 'uploads/service/'.$image_name;


            $service->update();
            return response()->json([
                'status' => 200,
                'message' => 'services data updated successfully',
            ]);
        }
    }


    public function destroy ($id)
    {
        Service::destroy($id);
        return response()->json([
           'status' => 200,
           'message' => "service bien supprimer"
        ]);
    }
}
