<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $article = Article::all();
        return response()->json([
            'status'=>200,
            'articles'=>$article
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'model' => 'required',
            'edition' => 'required',
            'description' => 'required',
            'id_marque' => 'required',
            'id_categorie_utilisation' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);


        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = base_path('public/uploads/articles/');
            $image->move($destinationPath, $image_name);
            $article = new Article([
                'model' => $request->model,
                'edition' => $request->edition,
                'description' => $request->description,
                'id_marque' => $request->id_marque,
                'id_categorie_utilisation' => $request->id_categorie_utilisation,
                'image_path' => 'uploads/articles/' . $image_name,
            ]);
            $article->save();
            return response()->json([
                'status' => 200,
                'message' => 'Article Created'
            ]);
        }

    }

    public function show($id)
    {
        return Article::find($id);
    }

    public function update (Request $request, $id)
    {
        $article = Article::find($id);
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = base_path('public/uploads/articles/');
            $image->move($destinationPath, $image_name);

                $article->model = $request->model;
                $article->edition =  $request->edition;
                $article->description = $request->description;
                $article->id_marque = $request->id_marque;
                $article->id_categorie_utilisation = $request->id_categorie_utilisation;
                $article->image_path = 'uploads/articles/' . $image_name;

            $article->update();
            return response()->json([
                'status' => 200,
                'message' => 'Article updated'
            ]);
        }
    }

    public function destroy ($id)
    {
        Article::destroy($id);
        return response()->json([
            'status' => 200,
            'message' => 'Article deleted'
        ]);
    }
}
