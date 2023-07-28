<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'password' => bcrypt($request->password),
        ]);

        if ($user->save()) {
            return response()->json([
                'success' => true,
            ]);
        }
        return response()->json([
            'success' => false,
        ]);

    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Authentication successful, return a success response
        return response()->json(['message' => 'Login successful', 'user' => $user], 200);
    }


    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
