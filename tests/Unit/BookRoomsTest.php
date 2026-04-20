<?php

use App\BookRooms;
use App\Models\Booking;
use App\Models\BookingDetail;
use Illuminate\Support\Facades\DB;

$testClass=null;


beforeEach(function () {
    // Create a test class that uses the BookRooms trait
    $this->testClass = new class {
        use BookRooms;
    };

    // Seed the database with test data
    $this->seedTestData();
});

function seedTestData()
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

    // Create test room types
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
            'typeid' => (($i - 1) % 4) + 1, // Distribute across room types
            'roomNumber' => '10' . $i,
            'isAvailable' => true,
        ]);
    }
}

describe('checkInventory', function () {
    it('returns correct count of available rooms for a specific type', function () {
        // There should be 3 rooms of type 1 (Basic) available
        $count = $this->testClass->checkInventory(1, 1);
        expect($count)->toBe(3);
    });

    it('returns zero when no rooms are available', function () {
        // Mark all rooms of type 1 as unavailable
        DB::table('room')
            ->where('typeid', 1)
            ->update(['isAvailable' => false]);

        $count = $this->testClass->checkInventory(1, 1);
        expect($count)->toBe(0);
    });

    it('returns correct count for different room types', function () {
        // Type 2 (Couple) should have 3 rooms
        $count = $this->testClass->checkInventory(1, 2);
        expect($count)->toBe(3);

        // Type 3 (Family) should have 2 rooms (10 rooms / 4 types = 2 remainder 2)
        $count = $this->testClass->checkInventory(1, 3);
        expect($count)->toBe(3);
    });

    it('returns zero for non-existent hotel', function () {
        $count = $this->testClass->checkInventory(999, 1);
        expect($count)->toBe(0);
    });
});

describe('getRooms', function () {
    it('returns the correct number of rooms', function () {
        $rooms = $this->testClass->getRooms(1, 1, 2);
        expect($rooms)->toHaveCount(2);
    });

    it('returns rooms of the correct type', function () {
        $rooms = $this->testClass->getRooms(1, 1, 2);
        foreach ($rooms as $room) {
            expect($room->typeid)->toBe(1);
        }
    });

    it('returns rooms for the correct hotel', function () {
        $rooms = $this->testClass->getRooms(1, 1, 2);
        foreach ($rooms as $room) {
            expect($room->hotelid)->toBe(1);
        }
    });

    it('returns empty array when not enough rooms available', function () {
        // Request more rooms than available
        $rooms = $this->testClass->getRooms(1, 1, 100);
        expect($rooms)->toHaveCount(3); // Only 3 available
    });

    it('orders rooms by id ascending', function () {
        $rooms = $this->testClass->getRooms(1, 1, 2);
        expect($rooms[0]->id)->toBeLessThan($rooms[1]->id);
    });
});

describe('changeAvailability', function () {
    it('marks rooms as unavailable', function () {
        $rooms = $this->testClass->getRooms(1, 1, 2);

        // Verify rooms are now unavailable
        foreach ($rooms as $room) {
            $isAvailable = DB::table('room')
                ->where('id', $room->id)
                ->value('isAvailable');
            expect($isAvailable)->toBeFalse();
        }
    });

    it('does not affect other rooms', function () {
        $rooms = $this->testClass->getRooms(1, 1, 1);

        // Check that rooms of other types are still available
        $otherRoomAvailable = DB::table('room')
            ->where('typeid', '!=', 1)
            ->where('isAvailable', true)
            ->exists();
        expect($otherRoomAvailable)->toBeTrue();
    });
});

describe('getBasicRooms', function () {
    it('returns basic rooms (type 1)', function () {
        $rooms = $this->testClass->getBasicRooms(1, 2);
        foreach ($rooms as $room) {
            expect($room->typeid)->toBe(1);
        }
    });
});

describe('getCoupleRooms', function () {
    it('returns couple rooms (type 2)', function () {
        $rooms = $this->testClass->getCoupleRooms(1, 2);
        foreach ($rooms as $room) {
            expect($room->typeid)->toBe(2);
        }
    });
});

describe('getFamilyRooms', function () {
    it('returns family rooms (type 3)', function () {
        $rooms = $this->testClass->getFamilyRooms(1, 2);
        foreach ($rooms as $room) {
            expect($room->typeid)->toBe(3);
        }
    });
});

describe('getDeluxeRooms', function () {
    it('returns deluxe rooms (type 4)', function () {
        $rooms = $this->testClass->getDeluxeRooms(1, 2);
        foreach ($rooms as $room) {
            expect($room->typeid)->toBe(4);
        }
    });
});