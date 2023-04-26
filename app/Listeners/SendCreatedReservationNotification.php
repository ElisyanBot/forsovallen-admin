<?php

namespace App\Listeners;

use App\Events\CreatedReservation;
use App\Models\ReserveRoom;
use App\Notifications\CreatedReservationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class sendCreatedReservationNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CreatedReservation $event): void
    {
        CreatedReservationNotification::class;
    }
}
