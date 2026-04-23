<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $table = 'booking';

    protected $fillable = [
        'custid',
        'room_id',
        'bookingStatus',
        'startDate',
        'endDate',
    ];
}
