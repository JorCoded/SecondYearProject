<?php

namespace App\Models;

//use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;
    protected $table = 'room';

    protected $fillable = [
        'isAvailable',
        'roomNumber',
        'floor',
        'picture',
        'typeid',
        'hotelid'
    ];

    public function test(){
        return null;
    }

}
