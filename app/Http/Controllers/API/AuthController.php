<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends BaseController
{
    public function signup(Request $request)
    { //using validator class new feature than method
        $validateUser = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]
        );

        if ($validateUser->fails()) {
            // return response()->json(
            //     [
            //         'status' => false,
            //         'message' => 'Validation Error',
            //         'errors' => $validateUser->errors()->all()
            //     ],
            //     401
            // );
            return $this->sendError('Validation Error', $validateUser->errors()->all(), 401);

        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        if ($user) {
            // return response()->json([
            //     'status' => true,
            //     'message' => 'User Created Successfully',
            //     'userid' => $UserId
            // ], 200);
            //encrypting user id before sending to user
            $encryptedUserId = encrypt($user->id); 
            return $this->sendResponse(['userid' => $encryptedUserId], 'User Created Successfully');

        } else {
            // If user creation failed for some reason
            return $this->sendError('Something went wrong, Registration failed', [], 500);
        }


    }


    public function login(Request $request)
    {

        $validateUser = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        if ($validateUser->fails()) {
            // return response()->json(
            //     [
            //         'status' => false,
            //         'message' => 'Authentication Fails',
            //         'errors' => $validateUser->errors()->all()
            //     ],
            //     402
            // );

            return $this->sendError('Validation Error', $validateUser->errors()->all(), 401);
        }

        //login user and also check if user email is verified or not if its not send code with message to verify email.
        $authUser = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if ($authUser) {
            $authUser = Auth::user();
            if ($authUser->email_verified == false) {
                // return response()->json([ 
                //     'status' => false,
                //     'message' => 'Email is not verified',
                //     'user' => $authUser
                // ], 401);
                return $this->sendError('Email is not verified', $authUser, 401);
            }

            // return response()->json([
            //     'status' => true,
            //     'message' => 'User Logged in Successfully',
            //     'token' => $authUser->createToken('API Token')->plainTextToken,
            //     'token_type' => 'bearer'
            // ], 200);

            return $this->sendResponse([
                'token' => $authUser->createToken('API Token')->plainTextToken,
                'token_type' => 'bearer'
            ], 'User Logged in Successfully');

        } else {
            // return response()->json([
            //     'status' => false,
            //     'message' => 'Authentication Fails',
            //     'errors' => 'Invalid Credentials'
            // ], 402);

            return $this->sendError('Authentication Fails', 'Invalid Credentials', 402);
        }

    }

    public function logout(Request $request)
    {
        $user = $request->user();
        
        $user->tokens()->delete();

        // return response()->json([
        //     'status' => true,
        //     'message' => 'You Logged Out Successfully',

        // ], 200);
        if ($user) {
            return $this->sendResponse([], 'You Logged Out Successfully');
        } else {
            return $this->sendError('Something went wrong, Logout failed', [], 401);
        }


    }
}
