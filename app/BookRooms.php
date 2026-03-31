<?php

namespace App;
use Illuminate\Support\Facades\DB;


trait BookRooms
{
    public function checkInventory(?int $hotelid = 1,?int $typeid = 1)
    {
        $inventory = /* DB::select('select count(typeid) from room where "isAvailable" = ? AND "typeid" =? AND "hotelid" = ?', [1, $typeid, $hotelid])[0] */
        DB::table('room')
                ->where('isAvailable', true)
                ->where('hotelid', $hotelid)
                ->where('typeid', $typeid)
                ->count();
        $count = $inventory;
        
        //return view('test', ['inventory' => $inventory, 'flag' => $count<5?false:true]);
        return $count/* <5?false:true */;
    }

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
