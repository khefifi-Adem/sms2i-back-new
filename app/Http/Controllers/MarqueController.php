<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use Illuminate\Http\Request;

class MarqueController extends Controller
{
    public function index()
    {
        return Marque::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'marque' => 'required',
            'description' => 'required',
            'image_alt' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);


        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('uploads/marques/');
            $image->move($destinationPath, $image_name);
            $marque = new Marque([
                'marque' => $request->marque,
                'description' => $request->description,
                'image_alt' => $request->image_alt ,
                'image_path' => 'uploads/marques/'.$image_name,
            ]);
            $marque->save();
        }
        else
        {
            return response ('mession failed',400);
        }
    }

    public function show($id)
    {
        return Marque::find($id);
    }

    public function update (Request $request, $id)
    {
        $marque = Marque::find($id);
        $marque->update($request->all());
        return $marque;
    }

    public function destroy ($id)
    {
        return Marque::destroy($id);
    }
}
