<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

// lazy to build form request , need to finish it fast
class LoginController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|min:10'
        ]);

        $user = User::query()->firstOrCreate([
            'phone' => $request->phone
        ]);

        if (!$user) {
            return response()->json(['message' => 'Could not process a user with that phone number.'], 401);
        }

        $user->notify();
    }

    public function verify(Request $request)
    {

    }
}
