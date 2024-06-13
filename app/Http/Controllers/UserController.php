<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $currentUser = Auth::user();
        if (!$currentUser || ($currentUser->role_id !== 1 && $currentUser->id !== $id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'password' => 'sometimes|required|string|min:6',
                'role_id' => 'required|exists:roles,id',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
        
        $user->name = $validatedData['name'];
        $user->role_id = $validatedData['role_id'];

        if (isset($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return response()->json(['message' => 'User updated successfully', 'data' => $user], 200);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $currentUser = Auth::user();
        if (!$currentUser || ($currentUser->role_id !== 1 && $currentUser->id !== $id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
