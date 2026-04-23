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
        $numRooms = 5;
        $type = 2;
        /* $inventory = [
            'Basic' => $this->checkInventory($hotelid, 1),
            'Couple' => $this->checkInventory($hotelid, 2),
            'Family' => $this->checkInventory($hotelid, 3),
            'Deluxe' => $this->checkInventory($hotelid, 4),
        ]; */
        $inventory = $this->checkInventory($hotelid, $type);
        if ($inventory < $numRooms) {
            return redirect()->route('home')->with('status', "Only {$inventory} rooms available. You requested {$numRooms} rooms. Please try another day.");
        }
        $rooms = $this->getRooms($hotelid, $type, $numRooms);
        return view('test', ['rooms' => $rooms, 'inventory' => $inventory]);
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

    public function roomType($amountOfPeople)
    {
        switch ($amountOfPeople) {
            case 1:
                return "Basic";
            case 2:
                return "Couple";
            case 3:
                return "Family";
            case 4:
                return "Deluxe (couple)";
        }
    }

    public function getRoomPrice($typeid = 1)
    {
        $price = DB::table('room_type')->where('id', $typeid)->get('basePrice')[0]->basePrice;
        return $price;
    }


    public function getDetails(Request $request, ?int $hotelid = 1)
    {
        //1. Capture booking details from 'hotels'
        //form using POST method
        //echo app(\App\Services\AuthService::class)->user();
        $userid = app(\App\Services\AuthService::class)->user()->id ?? 1;
        /* $request->validate([
            'startDate' => 'required',
            'amountOfPeople' => 'required',
            'numOfRooms' => 'required'

        ]); */
        $dates = explode(" to ", $request->startDate);
        $startDate = new DateTime($dates[0]) ?? null;
        $endDate = new DateTime($dates[1]) ?? null;
        $duration =  $endDate->diff($startDate)->days;
        $amountOfPeople = (int) $request->amountOfPeople;
        $numOfRooms = (int) $request->numOfRooms;

        $availableRooms = $this->checkInventory($hotelid, $amountOfPeople);

        /* $details=[
            "startDate"=>$request->startDate,
            "endDate"=>$request->endDate,
            "amountOfPeople"=>$request->amountOfPeople,
        ]; */

        if ($availableRooms === 0) {
            return redirect()->route('hotels', ['rooms' => $availableRooms])->with('status', "{$request->amountOfPeople} No rooms available. Please try another day. {$request->test}");
        } else if ($availableRooms < $numOfRooms) {
            return redirect()->route('hotels', ['rooms' => $availableRooms])->with('status', "Only {$availableRooms} rooms available. You requested {$numOfRooms} rooms. Please try another day.");
        }

        session(['booking_data' => [
            'startDate' => $startDate->format('Y-m-d'),
            'endDate' => $endDate->format('Y-m-d'),
            'duration' => $duration,
            'roomType' => $this->roomType($request->amountOfPeople),
            'amountOfPeople' => (int) $request->amountOfPeople,
            'numOfRooms' => $request->numOfRooms,
            'hotelid' => $hotelid,
            'userid' => $userid,
        ]]);

        //return redirect()->route('welcome')->with('status', 'Registered successfully. Please log in.');
        return $this->displayPayment($request, $hotelid);
        //;
    }


    public function displayPayment(Request $bookingRequest, $hotelid = 1)
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
        $startDate = $startDate->format('l, F j, Y');
        $endDate = $endDate->format('l, F j, Y');

        $bookingData = session('booking_data');
        $userid = $bookingData['userid'];
        $bookingData['amountOfPeople'] =(int) $bookingRequest->amountOfPeople;
        //$hotelid = $bookingData['hotelid'];

        /* session(['booking_data'=>[
            'startDate'=>$startDate,
            'endDate' => $endDate,
            'duration'=> $duration,
            'numOfRooms' => $bookingRequest->numOfRooms,
            'hotelid' => $hotelid,
            'userid' => app(\App\Services\AuthService::class)->user()->id ?? 1,
            'totalPrice'=> $totalPrice,
            'roomType' => $this->roomType($bookingRequest->amountOfPeople),

        ]]); */

        /*  $rooms = DB::table('room')
            ->join('room_type', 'room.typeid', '=', 'room_type.id')
            ->where('room.hotelid', $hotelid)
            ->where('room_type.capacity', '>=', $bookingRequest->amountOfPeople)
            ->whereNotIn('room.id', function($query) use ($bookingRequest) {
                // Exclude already booked rooms for these dates
                $query->select('booking_details.roomid')
                    ->from('booking_details')
                    ->join('bookings', 'booking_details.bookingid', '=', 'bookings.id')
                    ->where(function($q) use ($bookingRequest) {
                        $q->whereBetween('bookings.startDate', [$bookingRequest->startDate, $bookingRequest->endDate])
                          ->orWhereBetween('bookings.endDate', [$bookingRequest->startDate, $bookingRequest->endDate])
                          ->orWhere(function($subQ) use ($bookingRequest) {
                              $subQ->where('bookings.startDate', '<=', $bookingRequest->startDate)
                                   ->where('bookings.endDate', '>=', $bookingRequest->endDate);
                          });
                    });
            })
            ->orderBy('room.id', 'asc')
            ->limit($bookingRequest->numOfRooms)
            ->get(['room_type.basePrice', 'room.id', 'room.roomNumber']);
         
        $totalPrice = $rooms->sum('basePrice') * $duration;
        */


        return view('paymentForm', ['bookingRequest' => $bookingRequest, 'userid' => $userid, 'price' => $this->getRoomPrice($bookingRequest->amountOfPeople), 'totalPrice' => $totalPrice, 'hotelid' => $hotelid, 'duration' => $duration, 'rooms' => $bookingRequest->numOfRooms, 'startDate' => $startDate, 'endDate' => $endDate, 'roomType' => $this->roomType($bookingRequest->amountOfPeople),'amountOfPeople' =>(int) $bookingRequest->amountOfPeople]);
    }

    public function processPayment(Request $request, ?int $hotelid = 1)
    {
        //3. Process the payment, if everything is valid then processBooking
        //If payment is successful then processBooking
        //Since not using payment portal or payment logic, a placeholder will be used

        $userid = app(\App\Services\AuthService::class)->user()->id ?? 1;

        $bookingData = session('booking_data');

        if (!$bookingData) {
            return redirect()->route('hotels')
                ->with('error', 'Booking session expired. Please try again.');
        }

        // Validate payment data (add your payment fields here)
        $validated = $request->validate([
            'country' => 'required',
            'cardNum' => 'required',
            'expMonth' => 'required',
            'expYear' => 'required',
            'csc' => 'required',
        ]);

        // Process payment logic here (not implementing payment logic for project)
        $paymentSuccessful = true;

        if ($paymentSuccessful) {
            return $this->processBooking($request, $hotelid, $userid,$request->amountOfPeople);
        }

        return redirect()->route('paymentForm')
            ->with('error', 'Payment failed. Please try again.');
    }



    public function processBooking(Request $request, ?int $hotelid = 1, ?int $userid = 1, $amountOfPeople)
    {
        //4. When payment is done, process all details and book the rooms, update the database 
        //and provide customer with a message of success.

        //$this->processPayment($request);

        $bookingData = session('booking_data');
        //$userid = $bookingData['userid'];


        $rooms = [];
        $rooms = $this->getRooms($hotelid, (int) $amountOfPeople, $bookingData['numOfRooms']);
        //$this->changeAvailability(/* $hotelid, $rooms */);


        $booking = Booking::create([

            'bookingStatus' => "Payment Done",
            'startDate' => $bookingData['startDate'],
            'endDate' => $bookingData['endDate'],
            'custid' => $userid
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

        return redirect()->route('home')->with('status', 'Booking Successful! Checkout the details of your bookings in the "Bookings" section in your profile page.');
        //return view('home', ['rooms'=>$rooms]);
        //return $this->processPayment($request);
    }

    public function displayBookings(){
        $userid = app(\App\Services\AuthService::class)->user()->id ?? 1;

        $bookings = DB::table('booking')
                ->where('booking.custid', $userid)
                ->get();
        $bookingDetails = [];
        foreach($bookings as $booking)
        {
            $bookingDetails[] = DB::table('booking_details')
                    ->where('booking_details.id',$booking->id)
                    ->get();

        }
        

    return view('bookings',['bookings' => $bookings, 'bookingDetails' => $bookingDetails]);

    }

}
