<?php

namespace App\Http\Controllers;

use App\Models\BookedRoom;
use App\Models\ReserveRoom;
use App\Models\RoomImage;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return room::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $room = Room::create($request->validate([
            'title' => 'required|string',
            'desc' => 'required|string',
            'beds' => 'required|int',
        ]));

        if($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,svg'
            ], [
                'image.image' => 'Filen måste vara en bild',
                'image.mimes' => 'Filen måste vara av typen jpeg, png, jpg eller svg',
            ]);
            $path = $request->file('image')->store('RoomImages','public');
            $room->image()->save(new RoomImage([
                'filename' => $path
            ]));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $room->update($request->validate([
            'title' => 'required|string',
            'desc' => 'required|string',
            'beds' => 'required|int',
        ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
    }

    public function getAvailableRooms(ReserveRoom $reserveRoom)
    {
        //todo: add to constructor
       $bookedRoom = resolve(BookedRoom::class);
       $bookedRoomIds = $bookedRoom->getBookedRoomIds($reserveRoom);

       return Room::whereNotIn('id', $bookedRoomIds)->get();
    }
    public function getRoomsByReservation(ReserveRoom $reserveRoom)
    {
        $bookedRoom = resolve(BookedRoom::class);

        return Room::whereIn('id', $bookedRoom->getBookedRoomsByReservedId($reserveRoom))->get();
    }}
