<?php

namespace App\Http\Controllers\auth\v1;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {

        // Validate the Request
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'password' => 'required'
        ]);

        // Add data to database
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        // Create token
        $token = $user->createToken('myapptoken')->plainTextToken;

        // Make Response
        // $responce = [
        //     'user' => $user,
        //     'token' => $token
        // ];

        // return Response($responce, 201);

        return response()->json([
            'status_code' => 200,
            'user' => $user
        ]);
    }
}
