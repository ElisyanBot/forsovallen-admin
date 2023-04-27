<?php

namespace App\Http\Controllers;

use App\Models\BookedRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class BookedRoomController extends Controller
{
    public function storeMultiple(Request $request)
    {
        $validated = $request->validate([
            'bookings' => 'required|array',
            'email' => 'required|email',
        ]);

        foreach ($validated['bookings'] as $booking) {
            BookedRoom::create($booking);
        }

        Notification::route('mail', $validated['email'])
            ->notify(new \App\Notifications\CreatedBookingNotification());
        //todo: send email to user that bookings are done

    }
}
