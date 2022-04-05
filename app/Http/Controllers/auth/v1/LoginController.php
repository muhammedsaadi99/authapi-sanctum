<?php

namespace App\Http\Controllers\auth\v1;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the Request
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // Check Email
        $user = User::where('email', $fields['email'])->first();

        // Check Password
        $passCheck = Hash::check($fields['password'], $user->password);

        if (!$user) {
            return response()->json([
                'status_code' => 400,
                'message' => 'Email not found'
            ]);
        }

        if (!$passCheck) {
            return response()->json([
                'status_code' => 400,
                'message' => 'Password not match'
            ]);
        }

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
            'user' => $user,
            'token' => $token
        ]);
    }
}
