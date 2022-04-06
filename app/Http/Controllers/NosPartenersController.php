<?php

namespace App\Http\Controllers;

use App\Models\NosPartener;
use Illuminate\Http\Request;

class NosPartenersController extends Controller
{
    public function index()
    {
        $parteners = NosPartener::all();
        return response()->json([
            'status' => 200,
            'partners' => $parteners,
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
            $destinationPath = base_path('uploads/partners/');
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
        $nos_parteners->update($request->all());
        return $nos_parteners;
    }

    public function destroy ($id)
    {
        return NosPartener::destroy($id);
    }
}
