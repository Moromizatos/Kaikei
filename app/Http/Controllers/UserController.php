<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // GET /users
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // POST /users
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->save();

        return response()->json($user);
    }

    // GET /users/{id}
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    // PUT /users/{id}
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->name = $request->name;
        $user->save();

        return response()->json($user);
    }

    // DELETE /users/{id}
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }
}
