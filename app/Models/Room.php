<?php

namespace App\Models;

//use Illuminate\Support\Facades\DB;
use App\Models\Promotion;
use App\Models\Hotel;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function test()
    {

    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotelid');
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'typeid');
    }

    public function scopeWithActivePromotion($query)
    {
        return $query->with(['promotions' => function ($q) {
            $now = now();
            $q->where('starts_at', '<=', $now)
                ->where('ends_at', '>=', $now);
        }]);
    }

    public function getCurrentPriceAttribute(){

    $promo = $this->promotions->first();

    if (!$promo) return $this->base_price;

    return $promo->type =='percentage' 
    ? $this->base_price * (1-($promo->discount_value/100))
    : max(0, $this->base_price - $promo->discount_value);


    }
}
