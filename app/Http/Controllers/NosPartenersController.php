<?php

namespace App\Http\Controllers;

use App\Models\NosPartener;
use Illuminate\Http\Request;

class NosPartenersController extends Controller
{
    public function index()
    {
        $partenrs = NosPartener::all();
        return response()->json([
            'status' => 200,
            'partners' => $partenrs,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'partener' => 'required',
            'partener_description' => 'required',
            'image_alt' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);


        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('public/uploads/partners/');
            $image->move($destinationPath, $image_name);
            $parteners = new NosPartener([
                'partener' => $request->partener,
                'partener_description' => $request->partener_description,
                'image_alt' => $request->image_alt ,
                'image_path' => 'uploads/partners/'.$image_name,
            ]);
            $parteners->save();
            return response()->json([
               'status' => 200,
               'message' => 'partener added successfully',
            ]);

        }else {
            return response()->json ([
                'status'=> 400,
                'message'=>'mession failed'
            ]);
        }
    }

    public function show($id)
    {
        return NosPartener::find($id);
    }

    public function update (Request $request, $id)
    {
        $nos_parteners = NosPartener::find($id);
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('public/uploads/partners/');
            $image->move($destinationPath, $image_name);

                $nos_parteners->partener = $request->partener;
                $nos_parteners->partener_description = $request->partener_description;
                $nos_parteners->image_alt = $request->image_alt;
                $nos_parteners->image_path = 'uploads/partners/'.$image_name;

            $nos_parteners->update();
            return response()->json([
                'status' => 200,
                'message' => 'partener updated successfully',
            ]);

        }}


    public function destroy ($id)
    {
         NosPartener::destroy($id);
        return response()->json([
            'status' => 200,
            'message' => 'partener deleted successfully',
        ]);
    }
}
