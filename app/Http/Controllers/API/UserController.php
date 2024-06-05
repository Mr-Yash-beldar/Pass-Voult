<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends BaseController{

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $userId=auth()->user()->id;
        
        $user=User::find($userId);

        
        if(!$user){
            return $this->sendError('User Not Found.', [], 404);
        }
        return $this->sendResponse($user, 'User fetched successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $userId=auth()->user()->id;
        $user=User::find($userId);
        if(!$user){
            return $this->sendError('User Not Found.', [], 404);
        }
        $validateUser = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'password' => 'required'
            ]
        );

        if ($validateUser->fails()) {
            return $this->sendError('Validation Error', $validateUser->errors()->all(), 401);
        }
        else{
            $user->name=$request->name;
            $user->password=$request->password;
            $user->save();
            return $this->sendResponse($user, 'User Updated Successfully, Check Your Email');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $userId=auth()->user()->id;
        $user=User::find($userId);
        if(!$user){
            return $this->sendError('User Not Found.', [], 404);
        }
        $user->tokens()->delete();
        $user->delete();
        //delete all token of it from table to
        return $this->sendResponse($user, 'User Deleted Successfully');
    }
}
