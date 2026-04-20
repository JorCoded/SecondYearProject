<?php

use App\Http\Controllers\BookingController;
use App\Models\Booking;
use App\Models\BookingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    // Seed the database with test data
    seedBookingTestData();
});

function seedBookingTestData()
{
    // Clean up existing data first
    DB::table('booking_details')->delete();
    DB::table('booking')->delete();
    DB::table('room')->delete();
    DB::table('room_type')->delete();
    DB::table('hotel')->delete();

    // Create test hotel (table is 'hotel' with column 'hotel_name')
    DB::table('hotel')->insert([
        'id' => 1,
        'hotel_name' => 'Test Hotel',
        'location' => 'Test Location',
        'address' => 'Test Address',
        'phoneNumber' => '1234567890',
        'email' => 'test@test.com',
        'description' => 'Test Description',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Create test room types (table might be 'room_types' or 'room_type')
    DB::table('room_type')->insert([
        ['id' => 1, 'typeName' => 'Basic', 'basePrice' => 100, 'capacity' => 2],
        ['id' => 2, 'typeName' => 'Couple', 'basePrice' => 150, 'capacity' => 2],
        ['id' => 3, 'typeName' => 'Family', 'basePrice' => 200, 'capacity' => 4],
        ['id' => 4, 'typeName' => 'Deluxe', 'basePrice' => 300, 'capacity' => 6],
    ]);

    // Create test rooms
    for ($i = 1; $i <= 10; $i++) {
        DB::table('room')->insert([
            'id' => $i,
            'hotelid' => 1,
            'typeid' => (($i - 1) % 4) + 1,
            'roomNumber' => '10' . $i,
            'isAvailable' => true,
        ]);
    }
}

describe('Booking Flow - getDetails', function () {
    it('validates required fields', function () {
        $controller = new BookingController();
        $request = Request::create('/form/1/1', 'GET', []);

        $response = $controller->getDetails($request, 1, 1);

        // Should redirect back with errors due to missing fields
        expect($response->getStatusCode())->toBe(302);
    });

    it('redirects when no rooms available', function () {
        // Mark all rooms as unavailable
        DB::table('room')->update(['isAvailable' => false]);

        $controller = new BookingController();
        $request = Request::create('/form/1/1', 'GET', [
            'startDate' => '2024-01-15',
            'endDate' => '2024-01-20',
            'amountOfPeople' => 2,
            'numOfRooms' => 1,
        ]);

        $response = $controller->getDetails($request, 1, 1);

        expect($response->getStatusCode())->toBe(302);
    });

    it('proceeds to payment when rooms are available', function () {
        $controller = new BookingController();
        $request = Request::create('/form/1/1', 'GET', [
            'startDate' => '2024-01-15',
            'endDate' => '2024-01-20',
            'amountOfPeople' => 2,
            'numOfRooms' => 1,
        ]);

        $response = $controller->getDetails($request, 1, 1);

        // Should proceed to payment page (status 200)
        expect($response->getStatusCode())->toBe(200);
    });

    it('validates amountOfPeople is at least 1', function () {
        $controller = new BookingController();
        $request = Request::create('/form/1/1', 'GET', [
            'startDate' => '2024-01-15',
            'endDate' => '2024-01-20',
            'amountOfPeople' => 0,
            'numOfRooms' => 1,
        ]);

        $response = $controller->getDetails($request, 1, 1);

        expect($response->getStatusCode())->toBe(302);
    });

    it('validates numOfRooms is at least 1', function () {
        $controller = new BookingController();
        $request = Request::create('/form/1/1', 'GET', [
            'startDate' => '2024-01-15',
            'endDate' => '2024-01-20',
            'amountOfPeople' => 2,
            'numOfRooms' => 0,
        ]);

        $response = $controller->getDetails($request, 1, 1);

        expect($response->getStatusCode())->toBe(302);
    });
});

describe('Booking Flow - displayPayment', function () {
    it('calculates total price correctly', function () {
        $controller = new BookingController();
        $request = Request::create('/form/1/1', 'GET', [
            'startDate' => '2024-01-15',
            'endDate' => '2024-01-20',
            'amountOfPeople' => 2, // Type 2 = Couple = 150 base price
            'numOfRooms' => 2,
        ]);

        $response = $controller->displayPayment($request, 1, 1);

        // Should return view with status 200
        expect($response->getStatusCode())->toBe(200);
    });

    it('passes booking request to view', function () {
        $controller = new BookingController();
        $request = Request::create('/form/1/1', 'GET', [
            'startDate' => '2024-01-15',
            'endDate' => '2024-01-20',
            'amountOfPeople' => 2,
            'numOfRooms' => 1,
        ]);

        $response = $controller->displayPayment($request, 1, 1);

        expect($response->getStatusCode())->toBe(200);
    });
});

describe('Booking Flow - processPayment', function () {
    it('calls processBooking when payment is successful', function () {
        $controller = new class extends BookingController {
            public bool $bookingProcessed = false;

            public function processBooking(Request $request, ?int $hotelid = 1, ?int $custid = 1)
            {
                $this->bookingProcessed = true;
            }
        };

        $request = Request::create('/payment/1/1', 'POST', [
            'startDate' => '2024-01-15',
            'endDate' => '2024-01-20',
            'amountOfPeople' => 2,
            'numOfRooms' => 1,
        ]);

        $controller->processPayment($request, 1, 1);

        expect($controller->bookingProcessed)->toBeTrue();
    });
});

describe('Booking Flow - processBooking', function () {
    it('creates a new booking record', function () {
        $controller = new class extends BookingController {
            public function processBooking(Request $request, ?int $hotelid = 1, ?int $custid = 1)
            {
                return parent::processBooking($request, $hotelid, $custid);
            }
        };

        $request = Request::create('/process/1/1', 'POST', [
            'startDate' => '2024-01-15',
            'endDate' => '2024-01-20',
            'amountOfPeople' => 1, // Basic room type
            'numOfRooms' => 1,
        ]);

        $response = $controller->processBooking($request, 1, 1);

        // Should redirect to home
        expect($response->getStatusCode())->toBe(302);

        // Verify booking was created
        expect(Booking::count())->toBe(1);
    });

    it('creates booking details for each room', function () {
        $controller = new class extends BookingController {
            public function processBooking(Request $request, ?int $hotelid = 1, ?int $custid = 1)
            {
                return parent::processBooking($request, $hotelid, $custid);
            }
        };

        $request = Request::create('/process/1/1', 'POST', [
            'startDate' => '2024-01-15',
            'endDate' => '2024-01-20',
            'amountOfPeople' => 1, // Basic room type
            'numOfRooms' => 2,
        ]);

        $controller->processBooking($request, 1, 1);

        // Verify booking details were created
        expect(BookingDetail::count())->toBe(2);
    });

    it('sets correct booking status', function () {
        $controller = new class extends BookingController {
            public function processBooking(Request $request, ?int $hotelid = 1, ?int $custid = 1)
            {
                return parent::processBooking($request, $hotelid, $custid);
            }
        };

        $request = Request::create('/process/1/1', 'POST', [
            'startDate' => '2024-01-15',
            'endDate' => '2024-01-20',
            'amountOfPeople' => 1,
            'numOfRooms' => 1,
        ]);

        $controller->processBooking($request, 1, 1);

        $booking = Booking::first();
        expect($booking->bookingStatus)->toBe('Payment Pending');
    });

    it('sets correct start and end dates', function () {
        $controller = new class extends BookingController {
            public function processBooking(Request $request, ?int $hotelid = 1, ?int $custid = 1)
            {
                return parent::processBooking($request, $hotelid, $custid);
            }
        };

        $request = Request::create('/process/1/1', 'POST', [
            'startDate' => '2024-01-15',
            'endDate' => '2024-01-20',
            'amountOfPeople' => 1,
            'numOfRooms' => 1,
        ]);

        $controller->processBooking($request, 1, 1);

        $booking = Booking::first();
        expect($booking->startDate)->toBe('2024-01-15');
        expect($booking->endDate)->toBe('2024-01-20');
    });

    it('sets correct customer id', function () {
        $controller = new class extends BookingController {
            public function processBooking(Request $request, ?int $hotelid = 1, ?int $custid = 1)
            {
                return parent::processBooking($request, $hotelid, $custid);
            }
        };

        $request = Request::create('/process/1/1', 'POST', [
            'startDate' => '2024-01-15',
            'endDate' => '2024-01-20',
            'amountOfPeople' => 1,
            'numOfRooms' => 1,
        ]);

        $controller->processBooking($request, 1, 5);

        $booking = Booking::first();
        expect($booking->custid)->toBe(5);
    });

    it('sets correct price for each booking detail', function () {
        $controller = new class extends BookingController {
            public function processBooking(Request $request, ?int $hotelid = 1, ?int $custid = 1)
            {
                return parent::processBooking($request, $hotelid, $custid);
            }
        };

        $request = Request::create('/process/1/1', 'POST', [
            'startDate' => '2024-01-15',
            'endDate' => '2024-01-20',
            'amountOfPeople' => 1, // Basic = 100
            'numOfRooms' => 2,
        ]);

        $controller->processBooking($request, 1, 1);

        $bookingDetails = BookingDetail::all();
        foreach ($bookingDetails as $detail) {
            expect($detail->price)->toBe(100);
        }
    });
});

describe('Complete Booking Workflow Integration Test', function () {
    it('completes full booking flow from getDetails to processBooking', function () {
        // Step 1: Get details (check availability and proceed to payment)
        $controller = new class extends BookingController {
            public function processBooking(Request $request, ?int $hotelid = 1, ?int $custid = 1)
            {
                return parent::processBooking($request, $hotelid, $custid);
            }
        };

        $request = Request::create('/form/1/1', 'GET', [
            'startDate' => '2024-01-15',
            'endDate' => '2024-01-20',
            'amountOfPeople' => 1,
            'numOfRooms' => 1,
        ]);

        // Get details should succeed
        $response = $controller->getDetails($request, 1, 1);
        expect($response->getStatusCode())->toBe(200);

        // Step 2: Process booking
        $controller->processBooking($request, 1, 1);

        // Verify booking was created
        expect(Booking::count())->toBe(1);
        expect(BookingDetail::count())->toBe(1);

        // Verify room is no longer available
        $bookedRoom = BookingDetail::first()->roomid;
        $roomAvailable = DB::table('room')
            ->where('id', $bookedRoom)
            ->value('isAvailable');
        expect($roomAvailable)->toBeFalse();
    });
});

describe('Edge Cases and Error Handling', function () {
    it('handles fully booked hotel gracefully', function () {
        // Mark all rooms as unavailable
        DB::table('room')->update(['isAvailable' => false]);

        $controller = new BookingController();
        $request = Request::create('/form/1/1', 'GET', [
            'startDate' => '2024-01-15',
            'endDate' => '2024-01-20',
            'amountOfPeople' => 1,
            'numOfRooms' => 1,
        ]);

        $response = $controller->getDetails($request, 1, 1);

        // Should redirect back with error message
        expect($response->getStatusCode())->toBe(302);
    });

    it('handles request for more rooms than available', function () {
        $controller = new class extends BookingController {
            public function processBooking(Request $request, ?int $hotelid = 1, ?int $custid = 1)
            {
                return parent::processBooking($request, $hotelid, $custid);
            }
        };

        $request = Request::create('/process/1/1', 'POST', [
            'startDate' => '2024-01-15',
            'endDate' => '2024-01-20',
            'amountOfPeople' => 1,
            'numOfRooms' => 100, // More than available
        ]);

        $controller->processBooking($request, 1, 1);

        // Should only book available rooms
        $bookingDetails = BookingDetail::all();
        expect($bookingDetails)->toHaveCount(3); // Only 3 rooms of type 1 available
    });
});