<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequests\CreateUserRequest;
use App\Http\Requests\UserRequests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use function Pest\Laravel\json;

class UserController extends Controller
{

    public function createUser(CreateUserRequest $request)  {
        $arrayValidatedData = $request->validated();

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

    public function updateUser(UpdateUserRequest $request, int $id) {
        $user = User::find($id);

        if(!$user) {
            return response()->json(['error' => 'user not found']); 
        }

        $arrayValidatedData = $request->validated();
        
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
