<?php

namespace App\Http\Controllers;

use App\Models\BookedRoom;
use Illuminate\Http\Request;

class BookedRoomController extends Controller
{
    public function storeMultiple(Request $request)
    {
        $validated = $request->validate(
            ['bookings' => 'required|array']
        );

        foreach ($validated['bookings'] as $booking) {
            BookedRoom::create($booking);
        }

        //todo: send email to user that bookings are done.
    }
}
