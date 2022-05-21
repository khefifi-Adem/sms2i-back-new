<?php

namespace App\Http\Controllers;

use App\Models\CardAcceuil;
use Illuminate\Http\Request;

class CardAcceuilController extends Controller
{
    public function index()
    {
        $cards = CardAcceuil::all();
        return response()->json([
            'status' => 200,
            'cards' => $cards,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'card_head' => 'required',
            'card_icon' => 'required',
            'card_text' => 'required'
        ]);
        CardAcceuil::create($request->all());
        return response()->json([
            'status'=> 200,
            'message' => 'card created successfully'
        ]);
    }

    public function show($id)
    {
        return CardAcceuil::find($id);
    }

    public function update (Request $request, $id)
    {
        $card = CardAcceuil::find($id);
        $card->update($request->all());
        return response()->json([
            'status'=> 200,
            'message'=> "updated successfully"
        ]);
    }

    public function destroy ($id)
    {
        CardAcceuil::destroy($id);
        return response()->json([
            'status'=> 200,
            'message'=> "card deleted successfully"
        ]);
    }
}
