<x-components.common-layout>
    <div class="">
        <h1>Your Bookings</h1>
        {{-- @dd($bookingDetails) --}}
       
        @foreach ($bookingDetails as $booking)
            <div class="card">
                <div class="card-body">

                    @if ($booking->endDate < $now)
                        <h3>Status: Concluded</h3><br>
                    @else
                        <h3>Status: Active</h3><br>
                    @endif

                    <h3>{{ $booking->startDate }} to {{ $booking->endDate }}</h3><br>
                   
                    {{-- hotel name --}}

                    {{-- room type and price --}}
                    <h3>Room Type: {{-- {{ $roomType }} --}}, Price: {{-- {{ $booking->price }} --}}</h3><br>
                    {{-- number of rooms --}}
                    <h3>Number of rooms: {{ count($bookingDetails) }}</h3><br>

                    {{-- total price --}}
                </div>
            </div><br>
        @endforeach
    </div>
    <style>
        .card {
            max-width: 800px;
            margin: 20px auto;
            padding: 25px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        h1 {
            font-size: 28px;
            color: #1a1a1a;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e0e0e0;
        }
        
        .card .card {
            background: #f9f9f9;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            margin-bottom: 15px;
            padding: 20px;
            box-shadow: none;
        }
        
        .card .card:hover {
            background: #f0f0f0;
            transition: background 0.2s ease;
        }
        
        .card-body {
            padding: 0;
        }
        
        h3 {
            font-size: 16px;
            color: #333;
            margin: 8px 0;
            line-height: 1.5;
        }
        
        h3:first-of-type {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 14px;
            font-weight: 600;
            margin-top: 0;
        }
        
        /* Style for "Status: Concluded" */
        .card .card h3:first-of-type:contains("Concluded") {
            background: #e0e0e0;
            color: #666;
        }
        
        /* Style for "Status: Active" */
        .card .card h3:first-of-type:contains("Active") {
            background: #e3f2fd;
            color: #1976d2;
        }
        
        h3:nth-of-type(2) {
            font-size: 17px;
            font-weight: 500;
            color: #2c3e50;
        }
        
        br {
            display: none;
        }
        
        /* Add spacing after each h3 except the last one */
        h3:not(:last-of-type) {
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 1px solid #eee;
        }
        
        /* Style the last h3 differently (Total Price) */
        h3:last-of-type {
            margin-top: 15px;
            padding-top: 12px;
            border-top: 2px solid #1976d2;
            font-size: 18px;
            font-weight: 600;
            color: #1976d2;
        }
    </style>
</x-components.common-layout>
