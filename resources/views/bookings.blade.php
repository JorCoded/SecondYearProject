<x-components.common-layout>
    <div class="card">
        <h1>Your Bookings</h1>

        @foreach ($bookingDetails as $bookingDetail)
            <div class="card">
                <div class="card-body">

                    @if ($bookingDetail->endDate < $now)
                        <h3>Status: Concluded</h3><br>
                    @else
                        <h3>Status: Active</h3><br>
                    @endif

                    <h3>{{ $bookingDetail->startDate }} to {{ $bookingDetail->endDate }}</h3><br>
                    {{-- duration --}}
                    <h3>{{ $bookingDetail->duration }} Night(s)</h3><br>
                    {{-- hotel name --}}

                    {{-- room type and price --}}
                    <h3>Room Type: {{ $roomType }}, Price: {{ $bookingDetail->price }}</h3><br>
                    {{-- number of rooms --}}
                    <h3>Number of rooms: {{ $rooms }}</h3><br>

                    {{-- total price --}}
                    <h3>Total Price: {{ $totalPrice }} Mur</h3><br>
                </div>
            </div><br>
        @endforeach
    </div>
</x-components.common-layout>
