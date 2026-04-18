<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotel extends Model
{
    use HasFactory;
    use Searchable;

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

    public function toSearchableArray()
    {
        return [
            'hotel_name' => $this->hotel_name,
            'location' => $this->location
        ];
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'hotelid');
    }
}
