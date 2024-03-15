<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthUserController extends Controller {

    function registrationPost(Request $request) {
        // add validations for register
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'email' => 'required|unique:users',
            'contactno' => 'required',
            'role' => 'required'
        ]);
        if ($validator->fails()) {
            // Validation failed, return the error messages
            return response()->json(['error' => $validator->errors()], 400);
        }
        // format dataset & add to a new array
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'contactno' => $request->contactno,
            'role' => $request->role
        ];
        $user = User::create($data);
        if (!$user) {
            return response()->json(['message' => 'Registration Error!'], 500);
        } else {
            return response()->json(['message' => 'Registration Success!'], 200);
        }
    }

    function loginPost(Request $request) {
        // add validations for login
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return response()->json(['message' => 'Login Success!'], 200);
        } else {
            return response()->json(['message' => 'Login Error!'], 500);
        }
    }
}
