<x-components.common-layout>

    <a href="{{ route('home') }}">Home</a><br>
    <a href="{{ route('dashboard') }}">Dashboard</a><br>

    <div id="hotels-div">
        <h1>Hotels</h1>
        
        @foreach ($hotels as $hotel)
            <div id="hotel-card">
                <picture><img src="{{ $hotel->picture }}" alt=""></picture>
                <h2>{{ $hotel->hotel_name }}</h2>
                <p>{{ $hotel->description }}</p>
                <p>{{ $hotel->picture }}</p>
                <a href="{{route('/book',['hotelid' => $hotel->id])}}">Book</a>
            </div><br>
        @endforeach
    </div>

    <a href="{{ route('dashboard') }}">Dashboard</a><br>

    <a href="{{ route('addHotel') }}">Add Hotel</a>

</x-components.common-layout>
