<?php

namespace App\Http\Controllers;

use App\Models\ReserveRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ReserveRoomController extends Controller
{
    public function store(Request $request)
    {
        $reservation = ReserveRoom::create(request()->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'adults' => 'nullable|int',
            'children' => 'nullable|int',
            'tent_spots' => 'nullable|int',
            'caravan_spots' => 'nullable|int',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
        ]));

        \App\Models\User::first()
            ->notify(new \App\Notifications\ReservedRoomNotification($reservation));


        return redirect('/')->with('success', 'Din reservation har skapats');
    }

    public function show(ReserveRoom $reserveRoom)
    {
        return ReserveRoom::find($reserveRoom);
    }

    public function destroy(ReserveRoom $reserveRoom)
    {
        $reserveRoom->delete();
        return redirect('/admin/reservations')->with('success', 'Reservationen har tagits bort');
    }
}
