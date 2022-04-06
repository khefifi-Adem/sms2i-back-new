<?php

namespace App\Http\Controllers;

use App\Models\CategorieUtilisation;
use Illuminate\Http\Request;

class CategorieUtilisationController extends Controller
{
    public function index()
    {
        return CategorieUtilisation::all();
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
            $destinationPath = base_path('uploads/categorieArticle/');
            $image->move($destinationPath, $image_name);
            $cat_util = new CategorieUtilisation([
                'categorie' => $request->categorie,
                'description' => $request->description,
                'image_alt' => $request->image_alt ,
                'image_path' => 'uploads/categorieArticle/'.$image_name,
            ]);
            $cat_util->save();

        }
        else
        {
            return response ('mession failed',400);
        }
    }

    public function show($id)
    {
        return CategorieUtilisation::find($id);
    }

    public function update (Request $request, $id)
    {
        $cat_util = CategorieUtilisation::find($id);
        $cat_util->update($request->all());
        return $cat_util;
    }

    public function destroy ($id)
    {
        return CategorieUtilisation::destroy($id);
    }
}
