<?php

namespace App\Http\Controllers;

use App\Mail\sendOTPMail;
use App\Mail\sendUserUpdateMail;
use App\Models\OTP;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\API\BaseController;

class EmailController extends BaseController
{
    //Otp Email
    public function sendEmailforOTP($userid)
    {
        try {
            // Decrypt the user ID
            $UserId = (int)decrypt($userid);

            // Validate UserId
            if (!is_numeric($UserId)) {
                return $this->sendError('Invalid User ID', [], 400);
            }
           

            // Generate OTP
            $otp = rand(100000, 999999);
            $time = time(); // Use the Carbon `now()` method for current timestamp
           
            // Find the user
            $user = User::select('email')->find($UserId);
            // dd($user);
            if (!$user) {
                return $this->sendError('User not found', [], 404);
            }

            //get user email
            $useremail = $user->email;
           
            // Save OTP to database
            $otpStored=OTP::updateOrCreate(
                ['user_id' => (int) $UserId],
                ['code' => $otp, 'created_at' => $time]
            );

            if (!$otpStored) {
                return $this->sendError('Otp Not Stored in DB', [], 500);
            }
                       

            // Send OTP to user email
            $mailmessage = 'OTP for Email Verification';
            Mail::to($useremail)->send(new sendOTPMail( ['message' => $mailmessage, 'otp' => $otp]));
           
            return $this->sendResponse(['status'=>'true'], 'Email sent successfully');

        } catch (Exception $e) {
            // Log the exception message for debugging

            return $this->sendError('Something Went Wrong', [], 500);
        }   
    }


   
    
    

}


