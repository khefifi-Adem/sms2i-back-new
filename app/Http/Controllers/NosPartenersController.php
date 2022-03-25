<?php

namespace App\Http\Controllers;

use App\Models\NosParteners;
use http\Env\Response;
use Illuminate\Http\Request;

class NosPartenersController extends Controller
{
    public function index()
    {
        return NosParteners::all();
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
            $parteners = new NosParteners([
                'partener' => $request->partener,
                'partener_description' => $request->partener_description,
                'image_alt' => $request->image_alt ,
                'image_path' => 'uploads/partners/'.$image_name,
            ]);
            $parteners->save();
//            $parteners = new NosParteners;
//            $parteners->partener = $request->partener;
//            $parteners->partener_description = $request->partener_description;
//            $parteners->image_alt = $request->image_alt;
//            $image = $request->file('image');
//            $extension = $image->getClientOriginalExtension();
//            $imagename = time() . '.' . $extension;
//            $image->move('uploads/parteners/', $imagename);
//            $parteners->image_path = 'uploads/parteners/' . $imagename;
//
//            $parteners->save();
//
//            return response ('created successfully',200);
//        }else {
//            return response ('insert image',400);
//        }

        }else {
            return response ('mession failed',400);
        }
    }

    public function show($id)
    {
        return NosParteners::find($id);
    }

    public function update (Request $request, $id)
    {
        $nos_parteners = NosParteners::find($id);
        $nos_parteners->update($request->all());
        return $nos_parteners;
    }

    public function destroy ($id)
    {
        return NosParteners::destroy($id);
    }
}
