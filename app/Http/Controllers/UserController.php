<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\json;

class UserController extends Controller
{
    public function createUser(Request $request)  {
        $arrayValidatedData = $request->validate([
            'name' => 'string|required|max:255',
            'email' => 'string|required|email|unique:users,email',
            'password' => 'string|required|min:6'
        ]);

        $user = User::create([
            'name' => $arrayValidatedData['name'],
            'email' => $arrayValidatedData['email'],
            'password' => Hash::make($arrayValidatedData['password']),
        ]);

        return response()->json([
            'message' => 'user was registered in database!',
            'user' => $user,
        ]);    
    }
    
    public function getAllUsers() {
        $users = User::all();
        return response()->json($users);
    }

    public function getUser(int $id) {
        $user = User::find($id);
        
        if(!$user){
            return response()->json(['error' => 'user not found']); 
        }

        return response()->json($user);
    }

    public function updateUser(Request $request, int $id) {
        $user = User::find($id);

        if(!$user) {
            return response()->json(['error' => 'user not found']); 
        }

        $arrayValidatedData = $request->validate([
            'name' => 'string|required',
            'email' => 'string|required',
            'password' => 'string|required',
        ]);
        
        $user->update($arrayValidatedData);

        return response()->json([
            'message' => 'user has been updated',
            'user' => $user,
        ]);
    }

    public function deleteUser(Request $request, int $id) {
        $user = User::find($id);

        if(!$user) {
            return response()->json(['error' => 'user not found']); 
        } 

        $user->delete();

        return response()->json([
            'message' => 'user has been deleted',
            'user' => $user,
        ]);
    }
}
