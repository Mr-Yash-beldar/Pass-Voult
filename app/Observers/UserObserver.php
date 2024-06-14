<?php

namespace App\Observers;

use App\Http\Controllers\EmailController;
use App\Mail\sendUserUpdateMail;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Mail;
use Log;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //store id of user in verification code table
    
        $user->OTP()->create([
            'user_id' => $user->id,
        ]);

    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //send raw email to user as user is updated
            try {
                // Decrypt the user ID
                $UserId = $user->id;
                $username = $user->name;
    
                // Validate UserId
                if (!is_numeric($UserId)) {
                    echo 'Invalid User ID';
                }
              
                //get user email
                $useremail = $user->email;
                // Send OTP to user email
                $mailmessage = 'Your password has been changed';
            
                $maildata=['message' => $mailmessage, 'username' => $username];
                Mail::to($useremail)->send(new sendUserUpdateMail( $maildata));
                // echo 'Email sent successfully';
              
    
            } catch (Exception $e) {
                // Log the exception message for debugging
    
                echo "Something Went Wrong .$e";
            }
        
        
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
