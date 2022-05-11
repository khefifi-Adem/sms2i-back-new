<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

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
            $destinationPath = base_path('uploads/service/');
            $image->move($destinationPath, $image_name);
            $services = new Service([
                'titre' => $request->titre,
                'description' => $request->description,
                'image_path' => 'uploads/service/'.$image_name,
            ]);
            $services->save();

            return response()->json([
                'status' => 200,
                'service' => "service seccessfully added",
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
        $service->update($request->all());
        return $service;
    }

    public function destroy ($id)
    {
        return Service::destroy($id);
    }
}
