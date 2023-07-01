<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|unique:users|email',
            'password' => 'required|string|min:6',
            'is_owner' => 'required|boolean',
        ]);

        $user = User::create([
            'name' => $request->input('email'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'is_owner' => $request->input('is_owner'),
        ]);

        return response()->json(['message' => 'Data added successfully'], 200);
    }

     /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json(auth()->user());
    }
}
