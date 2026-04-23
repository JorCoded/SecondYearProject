<?php

use Illuminate\Support\Facades\DB;
if(!function_exists('getBookingDets')){
    function getBookingDets($bookingDetails){
        $booking = DB::table('booking')
                ->where('id', $bookingDetails->bookingid)
                ->get();;
    }
}