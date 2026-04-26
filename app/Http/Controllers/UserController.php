<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function store(Request $request) : JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:6',
        ]);
        $user = User::create($validated);
        return response()->json($user, 201);
    }

    public function index() : JsonResponse
    {
        $users = User::all();
        return response()->json($users);
    }

    public function find(int $id) : JsonResponse
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, int $id) : JsonResponse
    {
        $validated = $request->validate(['name' => 'required|string|max:50']);
        $user = User::findOrFail($id);
        $user->update($validated);
        return response()->json($user);
    }

    public function updateEmail(Request $request, int $id) : JsonResponse
    {
        $validated = $request->validate(['email' => 'required|string|email|max:50|unique:users,email,'.$id]);
        $user = User::findOrFail($id);
        $user->update($validated);
        return response()->json($user);
    }

    public function updatePassword(Request $request, int $id) : JsonResponse
    {
        $validated = $request->validate([
            'password' => 'required|string|min:6',
            'old_password' => 'required|string|min:6',
        ]);
        $user = User::findOrFail($id);
        if (!Hash::check($validated['old_password'], $user->password))
            return response()->json(['error' => 'Old password does not match'], 422);
        $user->update(['password' => $validated['password']]);
        return response()->json($user);
    }

    public function getPosts(int $id) : JsonResponse
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->get();
        return response()->json($posts);
    }

    public function delete(int $id) : JsonResponse
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }
}
