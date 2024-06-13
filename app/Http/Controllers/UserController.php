<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUserData(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json(['user' => $user]);
    }

    public function fetchAllUsers()
    {
        $users = User::with('role')->get();

        return response()->json(['users' => $users], 200);
    }

    public function createUser(Request $request)
    {
       
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = Auth::user();
        if (!$user || $user->role_id !== 1) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => $validatedData['role_id'],
        ]);

        return response()->json(['message' => 'User created successfully', 'data' => $user], 201);
    }
}
