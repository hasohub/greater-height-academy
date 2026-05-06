<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\StudentRecord;
use App\Models\TeacherRecord;
use App\Models\ParentRecord;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('mobile-app')->plainTextToken;

            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->roles()->first()->name ?? 'admin',
                ],
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials',
        ], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['success' => true, 'message' => 'Logged out']);
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->roles()->first()->name ?? 'admin',
            'phone' => $user->phone,
        ]);
    }
}
