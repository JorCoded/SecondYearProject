<?php

namespace App\Http\Controllers;

use App\BookRooms;
use App\Models\Booking;
use App\Models\BookingDetail;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    use BookRooms;

    public function test($hotelid)
    {

        $inventory = [
            'Basic' => $this->checkInventory($hotelid, 1),
            'Couple' => $this->checkInventory($hotelid, 2),
            'Family' => $this->checkInventory($hotelid, 3),
            'Deluxe' => $this->checkInventory($hotelid, 4),
        ];
        return view('test', ['inventory' => $inventory]);
    }


    public function index()
    {
        $bookings = Booking::all();
        return view('bookings', ['bookings' => $bookings]);
    }

    public function book(?int $hotelid = 1, ?int $custid = 1)
    {
        return view('bookingForm', ['hotelid' => $hotelid, 'custid' => $custid]);
    }

    public function testBooking(Request $request)
    {

        //$rooms = $this->getRooms();
        //$price = DB::table('room_type')->where('id', $rooms[0]->typeid)->get('basePrice')[0];
        // The number of records for which you want to sum the basePrice.
        $n = 5;

        $price = DB::table('room')
            ->join('room_type', 'room.typeid', '=', 'room_type.id')
            ->where('room.typeid', 1)
            ->orderBy('room.id', 'asc') // Order to get a consistent set of rooms
            ->limit($n)
            ->pluck('room_type.basePrice') // Get the prices for the first n rooms
            ->sum(); // Sum the prices in the collection

        $startDate = explode('-', $request->startDate)[2];
        $endDate = explode('-', $request->endDate)[2];
        //$endDate = ;
        //$duration = $endDate - $startDate;
        $duration = explode('-', $request->startDate)[2] - explode('-', $request->endDate)[2];

        return view('test', ['price' => $price, 'startDate' => $startDate, 'endDate' => $endDate, 'duration' => $duration/*, 'rooms'=>$rooms ->basePrice */]);
    }


    public function getDetails(Request $request, ?int $hotelid = 1, ?int $custid = 1)
    {
        //1. Capture booking details from 'hotels'
        //form must contain number of rooms

        $startDate = $request->startDate;
        $endDate = $request->endDate;


        $request->validate([
            'startDate' => 'required',
            'amountOfPeople' => 'required|min:1',
            'numOfRooms' => 'required|min:1'

        ]);

        /* $details=[
            "startDate"=>$request->startDate,
            "endDate"=>$request->endDate,
            "amountOfPeople"=>$request->amountOfPeople,
        ]; */


        if (($this->checkInventory($hotelid, (int) $request->amountOfPeople)) < 1) {
            return redirect()->route('hotels')->with('status', 'No rooms available. Please try another day.');
        }

        return $this->displayPayment($request, $hotelid, $custid);
    }


    public function displayPayment(Request $bookingRequest, $hotelid = 1, $custid = 1)
    {
        //2. Display details for confirmation and payment

        $totalPrice = DB::table('room')
            ->join('room_type', 'room.typeid', '=', 'room_type.id')
            ->where('room.typeid', $bookingRequest->amountOfPeople)
            ->orderBy('room.id', 'asc') // Order to get a consistent set of rooms
            ->limit($bookingRequest->numOfRooms)
            ->pluck('room_type.basePrice') // Get the prices for the first n rooms
            ->sum();
        $dates = explode(" to ", $bookingRequest->startDate);
        $startDate = new DateTime($dates[0]) ?? null;
        $endDate = new DateTime($dates[1]) ?? null;
        $duration =  $endDate->diff($startDate)->days;


        return view('paymentForm', ['bookingRequest' => $bookingRequest, 'totalPrice' => $totalPrice, $hotelid, $duration/* ->basePrice */]);
    }

    public function processPayment(Request $request, $hotelid = 1, $custid = 1)
    {
        //3. Process the payment, if everything is valid then processBooking
        //If payment is successful then processBooking
        //Since not using payment portal or payment logic, a placeholder will be used

        if (true)
            $this->processBooking($request, $hotelid, $custid);

        //return redirect()->route('bookings');
    }



    public function processBooking(Request $request, ?int $hotelid = 1, ?int $custid = 1)
    {
        //4. When payment is done, process all details and book the rooms, update the database 
        //and provide customer with a message of success.

        //$this->processPayment($request);


        $rooms = [];
        $rooms = $this->getRooms($hotelid, (int) $request->amountOfPeople, $request->numOfRooms);
        //$this->changeAvailability(/* $hotelid, $rooms */);


        $booking = Booking::create([
            'custid' => $custid,
            'bookingStatus' => "Payment Pending",
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
        ]);


        foreach ($rooms as $room) {
            BookingDetail::create([
                'bookingid' => $booking->id,
                'roomid' => $room->id,
                'price' => DB::table('room_type')
                    ->where('id', $room->typeid)
                    ->get('basePrice')[0]->basePrice
            ]);
        }

        //RoomController::checkInventory($hotelid, $request->amountOfPeople);

        return redirect()->route('home')->with('status', 'Booking Successful!<br>Checkout the details of your bookings <a href="{{ route("bookings") }}">here</a>');
        //return view('home', ['rooms'=>$rooms]);
        //return $this->processPayment($request);
    }
}
