<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\RegisterNotif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Register of a client
    public function randomString (int $i){
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFJHIJKLMNOPQRSTUVWXYZ', ceil($i)/ strlen($x))),1,$i);
    }
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

        return response()->json([
            'status'=> 200,
            'message'=>'Registred succesfully',
            'token' => $token,
            'user'=>$user
        ]);


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

            ]
        );
        $password = $this->randomString(8);

        $user =User::create([
            'nom' => $fields['nom'],
            'prenom' => $fields['prenom'],
            'num_tel' => $fields['num_tel'],
            'adresse' => $fields['adresse'],
            'email' => $fields['email'],
            'type' => 'formateur',
            'password' => bcrypt('Azerty1212'),
        ]);
        $user->notify(new RegisterNotif('Azerty1212'));


        return response()->json( [
            'status' => 200,
            'message' => "Formateur bien creer"
        ]) ;

    }

    //Register of a admin

    public function registerAdmin (Request $request)
    {
        $fields = $request->validate(
            [
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'num_tel' => 'required|integer',
                'adresse' => 'required|string',
                'email' => 'required|string|unique:users,email',

            ]
        );

        $password = $this->randomString(8);

        $user = User::create([
            'nom' => $fields['nom'],
            'prenom' => $fields['prenom'],
            'num_tel' => $fields['num_tel'],
            'adresse' => $fields['adresse'],
            'email' => $fields['email'],
            'type' => 'admin',
            'password' => bcrypt('Azerty1212'),
        ]);
        $user->notify(new RegisterNotif('Azerty1212'));


        return response()->json( [
            'status' => 200,
            'message' => "admin bien creer"
        ]) ;

    }

    //Register of a client Industriel



    public function registerIndusClient (Request $request)
    {
        $fields = $request->validate(
            [
                'nom_jurdique' => 'required|string',
                'num_tel' => 'required|integer',
                'adresse' => 'required|string',
                'email' => 'required|string|unique:users,email',

            ]
        );

        $password = $this->randomString(8);

         $user = User::create([
            'nom_jurdique' => $fields['nom_jurdique'],
            'num_tel' => $fields['num_tel'],
            'adresse' => $fields['adresse'],
            'email' => $fields['email'],
            'type' => 'client_indus',
            'password' => bcrypt('Azerty1212'),
        ]);
        $user->notify(new RegisterNotif('Azerty1212'));

        return response()->json([
            'status' => 200,
            'message' => 'Client industriel bien creer'
        ]);

    }





    //Logout methode
    public function logout (Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 200,
            'message'=>'Logged out'
        ]);
    }

    //Login  methode

    public function login (Request $request)
    {
        $fields= $request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);

        //check the email
        $user = User::where('email',$fields['email'])->first();
        if(!$user || !Hash::check($fields['password'],$user->password))
        {
            return response()->json([
                'status'=> 401,
                'message'=>'bad credits'
            ]);
        }

        $token = $user->createToken('sms2iapptoken')->plainTextToken;

        return response()->json([
            'status'=> 200,
            'message'=>'Connected succesfully',
            'token' => $token,
            'user'=>$user
        ]);


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
    public function show($id)
    {
        $user = User::find($id);

        return response()->json([
            'status' => 200,
            'users' => $user,
        ]);
    }

    public function indexFormateur()
    {
        $users = User::where('type','formateur')->get();
        return response()->json([
            'status' => 200,
            'users' => $users,
        ]);
    }

    public function indexAdmin()
    {
        $users = User::where('type','admin')->get();
        return response()->json([
            'status' => 200,
            'users' => $users,
        ]);
    }

    public function updatePassword (Request $request, $id)
    {

        if(!(Hash::check($request->password ,Auth::user()->getAuthPassword())))
        {
            return response()->json([
                'status'=> 401,
                'message'=>'wrong credits'
            ]);
        }
        $user = Auth::user();
        $user->password = bcrypt($request->newPassword);
        $user->save();
        return response()->json([
            'status'=> 200,
            'message'=>'Updated succesfully',

        ]);


    }

}
