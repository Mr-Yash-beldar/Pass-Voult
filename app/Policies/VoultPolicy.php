<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Voult;
use Illuminate\Auth\Access\Response;

class VoultPolicy
{
 

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Voult $voult): bool
    {
       
        return $user->id === decrypt($voult->user_id);
           
    }

    
  

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Voult $voult): bool
    {
        //as while getting id it should be encrypted so decrypt it first
    

        return $user->id === decrypt($voult->user_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Voult $voult): bool
    {
       
        return $user->id === decrypt($voult->user_id);
    }

    

}
