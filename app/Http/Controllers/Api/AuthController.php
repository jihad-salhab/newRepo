<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\apiresponseTrait;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    use apiresponseTrait;
   
    public function register(Request $request)
    {
       $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|string|max:15',
            'city' => 'required|string|max:100',
            'role' => 'required|in:admin,donor,beneficiary',
            'password' => 'required|confirmed|string|min:6'
        ]);
        
        
        
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'city' => $request->city,
                'role' => $request->role,
                'password_hash' => Hash::make($request->password),
                'is_verified' => false, 
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            
            //  return $this->apiRes($user,'User registered successfully',201);
            return response()->json([
                'user' => $user,
                'message' => 'User registered successfully',
                'access_token' => $token,
               
            ], 201);
        
    }

    //test
//     {
//     "name":"bashar",
//     "email": "bashar@12.com",
//     "phone": "09192",
//     "city": "damas",
//     "role": "beneficiary",
//     "password": "12345678",
//     "password_confirmation": "12345678"
// }








    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password_hash)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'message' => 'Login successful',
            'access_token' => $token
        ]);
    }

    






    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
