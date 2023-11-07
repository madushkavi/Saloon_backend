<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

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

    public function register(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        //     'password' => 'required',
        //     'phone' => 'required',
        //     'sex' => 'required',
        // ]);

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'sex' => $request->input('sex'),
            'password' => $request->input('password'),
        ]);

        try {
            if ($user->save()) {
                return response()->json(['status' => 'success', 'message' => 'user created successfully.']);
            } else {
                return response()->json(['status' => 'error', 'message'=> 'something went wrong.']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message'=> $th]);
        }
    }
}
