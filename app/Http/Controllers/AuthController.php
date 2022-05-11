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



        $response = [
            'user' => $user,
            'message' => 'Client industriel bien creer'
        ];

        return response($response, 201);
    }


    //Logout methode
    public function logout (Request $request)
    {
        auth()->user()->tokens()->delete();
        return[
            'message'=>'Logged out'
        ];
    }

    //Login  methode

    public function login (Request $request)
    {
        $fields= $request->validate([
            'email'=>'required|string',
            'passwoed'=>'required|string'
        ]);

        //check the email
        $user = User::where('email',$fields['email'])->first();
        if(!$user || !Hash::check($fields['password'],$user->password))
        {
            return response([
                'message'=>'bad credits'
            ],401);
        }

        $token = $user->createToken('sms2iapptoken')->plainTextToken;

        $response = [
            'user'=>$user,
            'token'=>$token
        ];

        return response
        (
            $response, 201
        );
    }

    public function indexClient()
    {
        $users = User::where('type','client')->get();
        return response()->json([
            'status' => 200,
            'users' => $users,
        ]);
    }

    public function indexClientIndus()
    {
        $users = User::where('type','client_indus')->get();
        return response()->json([
            'status' => 200,
            'users' => $users,
        ]);
    }

}
