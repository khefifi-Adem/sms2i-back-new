<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MarqueController extends Controller
{
    public function index()
    {

        $marque = Marque::all();
        return response()->json([
            'status'=>200,
            'marques'=>$marque
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'marque' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);


        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('public/uploads/marques/');
            $image->move($destinationPath, $image_name);
            $marque = new Marque([
                'marque' => $request->marque,
                'image_path' => 'uploads/marques/'.$image_name,
            ]);
            $marque->save();
            return response([
                'status' => 200,
                'message' => 'marque created'
            ]);
        }
        else
        {
            return response ('mession failed',400);
        }
    }

    public function show($id)
    {
        $marque = Marque::find($id);
        return response()->json([
           'status' => 200,
           'marque' => $marque
        ]);
    }

    public function update (Request $request, $id)
    {
        $marque = Marque::find($id);
        if ($request->hasFile('image_path')) {
            if (File::exists($marque->image_path)){
                File::delete($marque->image_path);
            }
            $image = $request->file('image_path');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = base_path('public/uploads/marques/');
            $image->move($destinationPath, $image_name);

            $marque->marque = $request->marque;
            $marque->image_path = 'uploads/marques/' . $image_name;

            $marque->update();
            return response([
                'status' => 200,
                'message' => 'marque updated'
            ]);
        }}

    public function destroy ($id)
    {
        Marque::destroy($id);
        return response()->json([
           'status'=> 200,
            'message' => 'deleted successfully'
        ]);
    }
}
