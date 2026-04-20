<x-components.common-layout :user="auth()->guard('customer')->user()" ? !null:"auth()->guard('staff')->user()" >

    <div id="hotels-div">
        <h1>Hotels</h1>
        
        @foreach ($hotels as $hotel)
            <div id="hotel-card">
                <picture><img src="{{ $hotel->picture }}" alt=""></picture>
                <h2>{{ $hotel->hotel_name }}</h2>
                <p>{{ $hotel->description }}</p>
                <p>{{ $hotel->picture }}</p>
                <a href="{{route('book',['hotelid' => $hotel->id,'custid' => $user->id])}}">Book</a>
            </div><br>
        @endforeach
    </div>

    <a href="{{ route('addHotel') }}">Add Hotel</a>

</x-components.common-layout>
