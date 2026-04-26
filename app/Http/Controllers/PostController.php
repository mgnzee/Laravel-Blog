<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function store(Request $request) : JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'user_id' => 'required|integer|exists:users,id'
        ]);
        $created = Post::create($validated);
        return response()->json($created, 201);
    }

    public function index() : JsonResponse
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    public function find(int $id) : JsonResponse
    {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    public function update(Request $request, int $id) : JsonResponse
    {
        $post = Post::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);
        $post->update($validated);
        return response()->json($post);
    }

    public function delete(int $id) : JsonResponse
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(null, 204);
    }
}
