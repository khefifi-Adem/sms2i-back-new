<?php

namespace App\Http\Controllers;

use App\Models\Page_intro;
use Illuminate\Http\Request;

class PageIntroController extends Controller
{
    public function index()
    {
        $page = Page_intro::all();
        return response()->json([
            'status' => 200,
            'pages' => $page,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_name' => 'required',
            'titre' => 'required',
            'description' => 'required',
            'image_path' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);


        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('uploads/pages/');
            $image->move($destinationPath, $image_name);
            $page = new Page_intro([
                'page_name' => $request->page_name,
                'titre' => $request->titre,
                'description' => $request->description ,
                'image_path' => 'uploads/pages/'.$image_name,
            ]);
            $page->save();
            return response()->json([
                'status' => 200,
                'message' => 'page data added successfully',
            ]);

        }else if ($request->hasFile('image_path')===false)
        {
            $page = new Page_intro([
                'page_name' => $request->page_name,
                'titre' => $request->titre,
                'description' => $request->description ,
            ]);
            $page->save();
            return response()->json([
                'status' => 200,
                'message' => 'page data added successfully',
            ]);
        }
        else
        {
            return response()->json ([
                'status'=> 400,
                'message'=>'mession failed'
            ]);
        }
    }


    public function show($id)
    {
        $page = Page_intro::find($id);

        return response()->json([
            'status' => 200,
            'pages' => $page,
        ]);
    }

    public function update (Request $request, $id)
    {
        $pages = Page_intro::find($id);
        $pages->update($request->all());
        return $pages;
    }

    public function destroy ($id)
    {
        return Page_intro::destroy($id);
    }
}
