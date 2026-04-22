<x-components.common-layout :user="Auth::guard('customer')->user() ?? Auth::guard('staff')->user()">
    {{-- @auth('customer')
        {{ Auth::guard('customer')->user()->firstname }}
    @endauth --}}

    {{-- Test if variables are available --}}
{{-- @php
    dd($currentUser ?? 'Not set', $userGuard ?? 'Not set');
@endphp --}}

    <div id="hotels-div">
        <h1>Hotels</h1>

        @foreach ($hotels as $hotel)
            {{-- <div class="hotel-card"> 
                <picture><img src="{{ $hotel->picture }}" alt="{{ $hotel->hotel_name }}"></picture>
                <h2>{{ $hotel->hotel_name }}</h2>
                <p>{{ $hotel->description }}</p>
            </div><br> --}}
            <div class="card" style="width: 18rem;">
                <img src="{{ $hotel->picture }}" class="card-img-top" alt="..." style="">
                <div class="card-body row" style="padding:10px;">
                    <h5 class="card-title col" style="margin-bottom: 0px">{{ $hotel->hotel_name }}</h5>
{{-- Auth::guard('customer')->user() ?? Auth::guard('staff')->user() --}}
                    @if (Auth::guard('customer')->check() || Auth::guard('staff')->check())
                        {{-- <x-book-button :hotelId="{{$hotel->id}}" :user="{{$currentUser->id}}"> 
                            Book Now
                        </x-book-button> --}}
                        <a href="{{ route('book', ['hotelid' => $hotel->id??0, 'custid' => $currentUser->id]) }}">Book Now</a> 
                    @else
                        <p class="col-8"><a href="{{ route('login') }}" style="text-decoration: none">Log in to book this hotel</a></p>
                    @endif
                </div>
            </div><br>
        @endforeach



    </div>

    {{-- <a href="{{ route('addHotel') }}">Add Hotel</a> --}}

</x-components.common-layout>
