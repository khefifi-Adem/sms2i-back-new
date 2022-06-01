<?php

namespace App\Http\Controllers;

use App\Models\CategorieUtilisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategorieUtilisationController extends Controller
{
    public function index()
    {

        $categorie = CategorieUtilisation::all();
        return response()->json([
            'status' => 200,
            'categories' => $categorie
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'categorie' => 'required',
            'description' => 'required',
            'image_alt' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);


        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('public/uploads/categorieArticle/');
            $image->move($destinationPath, $image_name);
            $cat_util = new CategorieUtilisation([
                'categorie' => $request->categorie,
                'description' => $request->description,
                'image_alt' => $request->image_alt ,
                'image_path' => 'uploads/categorieArticle/'.$image_name,
            ]);
            $cat_util->save();

        }
        return response()->json([
            'status' => 200,
            'message' => "Categorie created"
        ]);
    }

    public function show($id)
    {
        return CategorieUtilisation::find($id);
    }

    public function update (Request $request, $id)
    {
        $cat_util = CategorieUtilisation::find($id);

        if ($request->hasFile('image_path')) {
            if(File::exists($cat_util->image_path)) {
                File::delete($cat_util->image_path);
            }
            $image = $request->file('image_path');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('public/uploads/categorieArticle/');
            $image->move($destinationPath, $image_name);
            $cat_util->categorie = $request->categorie;
            $cat_util->description = $request->description;
            $cat_util->image_alt = $request->categorie;
            $cat_util->image_path = 'uploads/categorieArticle/'.$image_name;

            $cat_util->update();

        }
        return response()->json([
            'status' => 200,
            'message' => "Categorie created"
        ]);
    }


    public function destroy ($id)
    {
        CategorieUtilisation::destroy($id);
        return response()->json([
            'status' => 200,
            'message' => 'deleted successfully'
        ]);
    }
}
