<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Staff;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Promotion;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get dashboard statistics
        $stats = [
            'totalHotels' => Hotel::count(),
            'occupancyRate' => $this->calculateOccupancyRate(),
            'revenue' => $this->calculateTotalRevenue(),
        ];

        // Get all data for each section with relationships
        $customers = Customer::all();
        $staff = Staff::all();
        $hotels = Hotel::withCount('rooms')->get();
        $rooms = Room::with(['hotel', 'roomType'])->get();
        $roomTypes = RoomType::withCount('rooms')->get();
        $promotions = Promotion::all();

        return view('dashboard', compact(
            'stats',
            'customers',
            'staff',
            'hotels',
            'rooms',
            'roomTypes',
            'promotions'
        ));
    }

    private function calculateOccupancyRate()
    {
        $totalRooms = Room::count();
        if ($totalRooms == 0) return 0;
        
        $occupiedRooms = Room::where('isAvailable', false)->count();
        return round(($occupiedRooms / $totalRooms) * 100, 2);
    }

    private function calculateTotalRevenue()
    {
        // This would need to be adjusted based on your actual booking/payment structure
        // For now, returning a sample value
        return 45200;
    }

    public function editPage(){
        
    }

}
