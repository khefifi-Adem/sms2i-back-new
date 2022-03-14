<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Register of a client

    public function registerClient (Request $request)
    {
        $fields = $request->validate(
            [
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'num_tel' => 'required|integer',
                'adresse' => 'required|string',
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string|confirmed'
            ]
        );

        $user = User::create([
            'nom' => $fields['nom'],
            'prenom' => $fields['prenom'],
            'num_tel' => $fields['num_tel'],
            'adresse' => $fields['adresse'],
            'email' => $fields['email'],
            'type' => 'client',
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('sms2i_client_auth_token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    //Register of a formateur

    public function registerFormateur (Request $request)
    {
        $fields = $request->validate(
            [
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'num_tel' => 'required|integer',
                'adresse' => 'required|string',
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string|confirmed'
            ]
        );

        $user = User::create([
            'nom' => $fields['nom'],
            'prenom' => $fields['prenom'],
            'num_tel' => $fields['num_tel'],
            'adresse' => $fields['adresse'],
            'email' => $fields['email'],
            'type' => 'formateur',
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('sms2i_client_auth_token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    //Register of a client Industriel

    public function registerIndusClient (Request $request)
    {
        $fields = $request->validate(
            [
                'nom_juridique' => 'required|string',
                'num_tel' => 'required|integer',
                'adresse' => 'required|string',
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string|confirmed'
            ]
        );

        $user = User::create([
            'nom_juridique' => $fields['nom_juridique'],
            'num_tel' => $fields['num_tel'],
            'adresse' => $fields['adresse'],
            'email' => $fields['email'],
            'type' => 'client_indus',
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('sms2i_client_auth_token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }



}
