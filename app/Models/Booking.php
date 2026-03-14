<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $table = 'booking';

    protected $fillable = [
        'customer_id',
        'room_id',
        'bookingStatus',
        'startDate',
        'endDate',
    ];
}
