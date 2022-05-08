<?php

namespace App\Http\Controllers;

use App\Models\Card_etape;
use Illuminate\Http\Request;

class CardEtapeController extends Controller
{
    public function index()
    {
        $cards = Card_etape::all();
        return response()->json([
            'status' => 200,
            'cards' => $cards,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'icon' => 'required',
            'description' => 'required'
        ]);
        Card_etape::create($request->all());
        return response()->json([
            'status'=> 200,
            'message' => 'card created successfully'
        ]);
    }

    public function show($id)
    {
        return Card_etape::find($id);
    }

    public function update (Request $request, $id)
    {
        $card = Card_etape::find($id);
        $card->update($request->all());
        return $card;
    }

    public function destroy ($id)
    {
        return Card_etape::destroy($id);
    }
}
