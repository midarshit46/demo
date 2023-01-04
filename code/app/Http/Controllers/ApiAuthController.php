<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function createAccount(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
          'Accept'=>'application/json',
          'username' => $user->email,
        ]);
    }
    //use this method to signin users
    public function signin(Request $request)
    {
        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            $user = User::where('email', $request['email'])->firstOrFail();
            return response()->json([

                'message' => 'login successfully.',
            ]);
        }
        else{
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }
    }
    // this method signs out users by removing tokens
    public function logout(Request $request)
    {

        auth()->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Tokens Revoked',
        ]);
    }
    public function showproduct(Request $request)
    {
         $data=Product::all();
        // $user = User::where('email', $request['email'])->firstOrFail();
       //$token =  $data->createToken('auth_token')->plainTextToken;

         return response()->json(['data'=>$data,
        ]);
    }

    public function update(Request $request,$id)
    {
        $product=User::find($id);
        $product->update($request->all());
        return response()->json(['data'=>'update successfully']);
    }
    public function delete(Request $request,$id)
    {

        $secretkey = $request->secretkey;
        if($secretkey == "darshit")
        {
            $product=Product::find($id);
            $product->delete();
            return response()->json(['data'=>'delete successfully']);
        }
        else
        {
            return response()->json(['data'=>'please enter key']);
        }

    }


}
