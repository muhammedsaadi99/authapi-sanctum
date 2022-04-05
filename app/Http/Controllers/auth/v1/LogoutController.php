<?php

namespace App\Http\Controllers\auth\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        // return [
        //     'message' => 'Logged Out'
        // ];

        return response()->json([
            'status_code' => 200,
            'message' => 'Logged Out'
        ]);
    }
}
