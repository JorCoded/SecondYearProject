<x-components.common-layout :user="Auth::guard('customer')->user() ?? Auth::guard('staff')->user()">
@auth('customer')
{{Auth::guard('customer')->user()->firstname}}
@endauth
    <div id="hotels-div">
        <h1>Hotels</h1>
        
        @foreach ($hotels as $hotel)
            <div id="hotel-card">
                <picture><img src="{{ $hotel->picture }}" alt=""></picture>
                <h2>{{ $hotel->hotel_name }}</h2>
                <p>{{ $hotel->description }}</p>
                <p>{{ $hotel->picture }}</p>
                <x-book-button :hotelId="$hotel->id" :user="$user ?? null">
                    Book Now
                </x-book-button>
            </div><br>
        @endforeach
    </div>

    {{-- <a href="{{ route('addHotel') }}">Add Hotel</a> --}}

</x-components.common-layout>
