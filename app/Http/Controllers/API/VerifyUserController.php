<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\OTP;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Validator;

class VerifyUserController extends Controller
{

    public function isUserVerified($userId)
    {
        $user = User::find($userId);
        if ($user->email_verified) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyUser(Request $request)
    {
        //if user enteres the correct otp then we will verify the user
        //validate the request and if error ocuured return it in json
        try {

            $validateRequest = Validator::make($request->all(), [
                'userId' => 'required',
                'otp' => 'required|numeric'
            ]);
            if ($validateRequest->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' => $validateRequest->errors()->all()
                ], 401);
            }
            $UserId = decrypt($request->userId);

            //check if userAlready Verified or Not
            $isAlreadyVerified = $this->isUserVerified($UserId);
            if ($isAlreadyVerified) {
                return response()->json([
                    'status' => false,
                    'message' => 'User Already Verified',
                ], 200);
            }
            

            $userdata = OTP::where('user_id', $UserId)->get(['code']);
            //if userdata has no record then return user not found
            if (!$userdata) {
                return response()->json([
                    'status' => false,
                    'message' => 'User Not Found',
                ], 404);
            }


            $otp = $userdata[0]->code;

            if ($otp != $request->otp) {
                //if otp is not correct then return invalid otp
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid OTP',
                ], 400);
            } else {
                //update the user email_verified field to true
                $user = User::find($UserId);
                $user->email_verified = true;
                $user->save();
                return response()->json([
                    'status' => true,
                    'message' => 'User Verified Successfully',
                    'user' => $user
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something Went Wrong',
            ], 500);
        }
    }
}
