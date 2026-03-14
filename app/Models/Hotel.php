<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hotel';

    protected $fillable=[
        'hotel_name',
        'location',
        'address',
        'phoneNumber',
        'email',
        'picture',
        'description'
    ];


}
