<?php

namespace App\Http\Controllers;

use App\Models\Groupe_sms2i;
use Illuminate\Http\Request;

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
        ]);
        Groupe_sms2i::create($request->all());
        return response()->json([
            'status'=> 200,
            'message' => 'Societe created successfully'
        ]);
    }

    public function show($id)
    {
        return Groupe_sms2i::find($id);
    }

    public function update (Request $request, $id)
    {
        $groupesms2i = Groupe_sms2i::find($id);
        $groupesms2i->update($request->all());
        return $groupesms2i;
    }

    public function destroy ($id)
    {
        return Groupe_sms2i::destroy($id);
    }
}
