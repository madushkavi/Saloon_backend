<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query'); 

        
        $results = User::where('name', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->get();

        return response()->json($results);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $role = Auth::user()->role;
            return response()->json(['isLogged' => true, 'role' => $role]);
        } else {
            return response()->json(['isLogged' => false, 'role' => '']);
        }
    }

    public function register(Request $request) {
        $request -> validate([
            'name' => 'required',
            'email' => 'required | email',
            'password' => 'required | min:6 | alpha_num',
            'phone' => 'required | min:10 | max:10',
            'sex' => 'required',
        ]);

        $user = new User([
            'name' => $request -> name,
            'email' => $request -> email,
            'phone' => $request -> phone,
            'sex' => $request -> sex,
            'password' => $request -> password,
        ]);

        if ($user -> save()) {
            return response()->json(['message' => 'user created successfully.']));
        } else {
            return response()->json(['message'=> 'something went wrong.']);
        }
    }
}
