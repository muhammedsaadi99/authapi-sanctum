<?php

namespace App\Http\Controllers\auth\v1;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return response()->json([
            'status_code' => 200,
            'message' => 'data updated successfuly',
            // 'user' => Auth::user() giving null value
        ]);
    }
}
