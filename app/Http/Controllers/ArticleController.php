<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $article = Article::with(['marque','category'])->get();
        return response()->json([
            'status'=>200,
            'articles'=>$article
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'article' => 'required',
            'description' => 'required',
            'id_marque'=>'required',
            'id_categorie_utilisation'=>'required',
            'image_alt' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);


        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('uploads/articles/');
            $image->move($destinationPath, $image_name);
            $article = new Article([
                'article' => $request->article,
                'description' => $request->description,
                'id_marque' => $request->id_marque ,
                'id_categorie_utilisation' => $request->id_categorie_utilisation ,
                'image_alt' => $request->image_alt ,
                'image_path' => 'uploads/articles/'.$image_name,
            ]);
            $article->save();


        }
        else
        {
            return response ('mession failed',400);
        }
    }

    public function show($id)
    {
        return Article::find($id);
    }

    public function update (Request $request, $id)
    {
        $article = Article::find($id);
        $article->update($request->all());
        return $article;
    }

    public function destroy ($id)
    {
        return Article::destroy($id);
    }
}
