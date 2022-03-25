<?php

namespace App\Http\Controllers;

use App\Models\CardAcceuil;
use Illuminate\Http\Request;

class CardAcceuilController extends Controller
{
    public function index()
    {
        return CardAcceuil::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'card_head' => 'required',
            'card_icon' => 'required',
            'card_text' => 'required'
        ]);
        return CardAcceuil::create($request->all());
    }

    public function show($id)
    {
        return CardAcceuil::find($id);
    }

    public function update (Request $request, $id)
    {
        $card = CardAcceuil::find($id);
        $card->update($request->all());
        return $card;
    }

    public function destroy ($id)
    {
        return CardAcceuil::destroy($id);
    }
}
