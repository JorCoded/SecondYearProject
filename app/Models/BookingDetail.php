<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    protected $table = 'booking_details';
    protected $fillable = [
        'bookingid',
        'roomid',
        'price',
        'bookingreceipt'
    ];
}
