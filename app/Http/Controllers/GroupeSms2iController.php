<?php

namespace App\Http\Controllers;

use App\Models\Groupe_sms2i;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GroupeSms2iController extends Controller
{
    public function index()
    {
        $groupesms2i = Groupe_sms2i::all();
        return response()->json([
            'status' => 200,
            'groupesms2i' => $groupesms2i,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_soc' => 'required',
            'description' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('public/uploads/groupesms2i/');
            $image->move($destinationPath, $image_name);
            $groupe = new Groupe_sms2i([
                'nom_soc' => $request->nom_soc,
                'description' => $request->description,
                'image_path' => 'uploads/groupesms2i/'.$image_name ,
            ]);
            $groupe->save();
            return response()->json([
                'status' => 200,
                'message' => 'society added perfectly'
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
        return Groupe_sms2i::find($id);
    }

    public function update (Request $request, $id)
    {
        $groupesms2i = Groupe_sms2i::find($id);

        if ($request->hasFile('image_path')) {
            if (File::exists($groupesms2i->image_path)){
                File::delete($groupesms2i->image_path);
            }
            $image = $request->file('image_path');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('public/uploads/groupesms2i/');
            $image->move($destinationPath, $image_name);

                $groupesms2i->nom_soc = $request->nom_soc;
                $groupesms2i->description = $request->description;
                $groupesms2i->image_path = 'uploads/groupesms2i/'.$image_name ;

            $groupesms2i->update();
            return response()->json([
                'status' => 200,
                'message' => 'society updated perfectly'
            ]);

        }
    }

    public function destroy ($id)
    {
        Groupe_sms2i::destroy($id);
        return response()->json([
            'status' => 200,
            'message' => 'society deleted perfectly'
        ]);
    }
}
