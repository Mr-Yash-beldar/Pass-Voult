<?php

namespace App\Observers;

use App\Models\Voult;

class VoultObserver
{
    /**
     * Handle the Voult "created" event.
     */
    public function created(Voult $voult): void
    {
        //
    }

    /**
     * Handle the Voult "updated" event.
     */
    public function updated(Voult $voult): void
    {
        //
    }

    /**
     * Handle the Voult "deleted" event.
     */
    public function deleted(Voult $voult): void
    {
        //
    }

    /**
     * Handle the Voult "restored" event.
     */
    public function restored(Voult $voult): void
    {
        //
    }

    /**
     * Handle the Voult "force deleted" event.
     */
    public function forceDeleted(Voult $voult): void
    {
        //
    }
}
