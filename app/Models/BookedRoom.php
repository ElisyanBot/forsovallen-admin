<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookedRoom extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'room_id',
        'reserve_room_id',
        'start_date',
        'end_date',
    ];

    public function room(): belongsTo
    {
        return $this->belongsTo(
            \App\Models\Room::class,
            'room_id',
        );
    }
    public function reservation(): belongsTo
    {
        return $this->belongsTo(
            \App\Models\ReserveRoom::class,
            'reserve_id',
        );
    }

    /**
     * Get all booked rooms from resereved_room dates
     */
    public function getBookedRoomIds(ReserveRoom $reserveRoom)
    {
        $roomIds = self::whereDate('start_date','<=', $reserveRoom->check_out)
            ->where(function ($q) use ($reserveRoom) {
                $q->whereDate('end_date', '>=', $reserveRoom->check_in);
            })->get();

        return array_unique($roomIds->pluck('room_id')->toArray());
    }
}
