<?php

namespace App;
use Illuminate\Support\Facades\DB;


trait BookRooms
{
    public function checkInventory(?int $hotelid = 1,?int $typeid = 1)
    {// DB::select('select count(typeid) from room where "isAvailable" = ? AND "typeid" =? AND "hotelid" = ?', [1, $typeid, $hotelid])[0]
        $inventory = 
        DB::table('room')
                ->where('isAvailable', true)
                ->where('hotelid', $hotelid)
                ->where('typeid', $typeid)
                ->count();
        //$count = $inventory;
        
        //return view('test', ['inventory' => $inventory, 'flag' => $count<5?false:true]); <5?false:true
        return $inventory;
    }

    
    /* private function checkInventory($hotelid, $typeid, $startDate, $endDate)
            {
                return $this->getAvailableRooms($hotelid, $typeid, $startDate, $endDate)->count();
            }

            private function getAvailableRooms($hotelid, $typeid, $startDate, $endDate)
            {
                return DB::table('room')
                    ->join('room_type', 'room.typeid', '=', 'room_type.id')
                    ->where('room.hotelid', $hotelid)
                    ->where('room.typeid', $typeid) // Direct comparison with typeid
                    ->whereNotIn('room.id', function($query) use ($startDate, $endDate) {
                        $query->select('booking_details.roomid')
                            ->from('booking_details')
                            ->join('booking', 'booking_details.bookingid', '=', 'booking.id')
                            ->where('booking.bookingStatus', '!=', 'Cancelled')
                            ->where(function($q) use ($startDate, $endDate) {
                                // Check for overlapping dates
                                $q->whereBetween('booking.startDate', [$startDate, $endDate])
                                ->orWhereBetween('booking.endDate', [$startDate, $endDate])
                                ->orWhere(function($subQ) use ($startDate, $endDate) {
                                    $subQ->where('booking.startDate', '<=', $startDate)
                                        ->where('booking.endDate', '>=', $endDate);
                                });
                            });
                    })
                    ->select('room.*', 'room_type.basePrice', 'room_type.id as roomTypeId')
                    ->orderBy('room.id', 'asc')
                    ->get();
            } 
    */

/*     private function checkInventory($hotelid, $typeid, $startDate, $endDate)
{
    return $this->getAvailableRooms($hotelid, $typeid, $startDate, $endDate)->count();
}

private function getAvailableRooms($hotelid, $typeid, $startDate, $endDate)
{
    // Simplified query - just get rooms that exist
    $query = DB::table('room')
        ->join('room_type', 'room.typeid', '=', 'room_type.id')
        ->where('room.hotelid', $hotelid)
        ->where('room.typeid', $typeid);
    
    // Check if there are any bookings that overlap
    $hasBookings = DB::table('booking_details')
        ->join('booking', 'booking_details.bookingid', '=', 'booking.id')
        ->where('booking.bookingStatus', '!=', 'Cancelled')
        ->where(function($q) use ($startDate, $endDate) {
            $q->where(function($subQ) use ($startDate, $endDate) {
                $subQ->where('booking.startDate', '<=', $endDate)
                     ->where('booking.endDate', '>=', $startDate);
            });
        })
        ->exists();
    
    if ($hasBookings) {
        // If there are bookings, exclude booked rooms
        $bookedRoomIds = DB::table('booking_details')
            ->join('booking', 'booking_details.bookingid', '=', 'booking.id')
            ->where('booking.bookingStatus', '!=', 'Cancelled')
            ->where(function($q) use ($startDate, $endDate) {
                $q->where(function($subQ) use ($startDate, $endDate) {
                    $subQ->where('booking.startDate', '<=', $endDate)
                         ->where('booking.endDate', '>=', $startDate);
                });
            })
            ->pluck('booking_details.roomid');
        
        if ($bookedRoomIds->isNotEmpty()) {
            $query->whereNotIn('room.id', $bookedRoomIds);
        }
    }
    
    return $query->select('room.*', 'room_type.basePrice', 'room_type.typeName')
                 ->orderBy('room.id', 'asc')
                 ->get();
}
 */


    public function changeAvailability(?int $hotelid = 1,$rooms=[],?int $typeid=1){
        //updates the availability of the rooms booked.
        foreach($rooms as $room){
            DB::table('room')
                ->where('id', $room->id)
                ->where('hotelid', $hotelid)
                ->update(
                    ['isAvailable' => 0]
                );
        }
    }

    public function getRooms($hotelid=1,$typeid=1,$numOfRooms=1){
        //
        $rooms = DB::table('room')
                ->where('isAvailable', true)
                ->where('hotelid', $hotelid)
                ->where('typeid', $typeid)
                ->orderBy('id', 'asc')
                ->limit($numOfRooms)
                ->get();
        $this->changeAvailability($hotelid,$rooms);
        return $rooms;
    }



    public function getBasicRooms($hotelid = 1, $numOfRooms=1)
    {   
        //loop the amount of time equal to the number of rooms chosen
        // $rooms = DB::select("select * from room where hotelid = ? AND ? = ? AND typeid = ? order by id limit ?", [$hotelid, "isAvailable", "true", 1, $numOfRooms]);
        $rooms = DB::table('room')
                ->where('isAvailable', true)
                ->where('hotelid', $hotelid)
                ->where('typeid', 1)
                ->orderBy('id', 'asc')
                ->limit($numOfRooms)
                ->get();
        $this->changeAvailability($hotelid, $rooms);
        return $rooms;
    }
    protected function getCoupleRooms($hotelid = 1, $numOfRooms=1)
    {
        $rooms = DB::table('room')
                ->where('isAvailable', true)
                ->where('hotelid', $hotelid)
                ->where('typeid', 2)
                ->orderBy('id', 'asc')
                ->limit($numOfRooms)
                ->get();
        $this->changeAvailability($hotelid, $rooms);
        return $rooms;
    }
    protected function getFamilyRooms($hotelid = 1, $numOfRooms=1)
    {
        $rooms = DB::table('room')
                ->where('isAvailable', true)
                ->where('hotelid', $hotelid)
                ->where('typeid', 3)
                ->orderBy('id', 'asc')
                ->limit($numOfRooms)
                ->get();
        $this->changeAvailability($hotelid, $rooms);
        return $rooms;
    }
    protected function getDeluxeRooms($hotelid = 1, $numOfRooms=1)
    {
        $rooms = DB::table('room')
                ->where('isAvailable', true)
                ->where('hotelid', $hotelid)
                ->where('typeid', 4)
                ->orderBy('id', 'asc')
                ->limit($numOfRooms)
                ->get();
        $this->changeAvailability($hotelid,$rooms);
        return $rooms;
    }

    

    public function getReceipts($custid=1){
        //returns an associative array containing details of the booking
        
        //$booking = DB::select('select * from booking');

        $receipt=[
            "bookingStatus"=>"",
            "startDate"=>"",
            "endDate"=>"",
            "price"=>"",
            "numberOfRooms"=>"",
            "rooms"=>"",
            "amountOfPeople"=>"",
        ];

        $receipts=[];
        
        $bookings = DB::table('booking')
                ->where('id', $custid)
                ->select('*');

        foreach($bookings as $booking)
        {
            //



            $receipt["bookingStatus"]=$booking->bookingStatus;
            $receipt["startDate"]=$booking->startDate;
            $receipt["endDate"]=$booking->endDate;
            $receipt["price"]= DB::table('booking_details')
                                ->where('bookingid', $booking->id)
                                ->select(DB::raw('sum(price)'))
                                ->get()[0]->sum;

        }

        $bookingDetails=DB::table('booking_details')
                ->where('id', $bookings[0]->id)
                ->select('*');

        
        //Problem with DB::select and $booking[n]
        //What if there are more than one booking/records?
        //foreach($bookingDetails-> as $rooms )

        


        return ;
    }

    public function test(){
        return "test Success";
    }

}
