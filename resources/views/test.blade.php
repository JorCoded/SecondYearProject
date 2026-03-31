<x-components.common-layout>
    {{-- @inject('bookRooms', 'App\BookRooms') --}}
    <h3><a href="{{ route('home') }}">Home</a></h3>
    <h3><a href="{{ route('dashboard') }}">Dashboard</a></h3>
    {{-- <h3><a href="{{ route('testBooking') }}">Test Booking</a></h3><br><br> --}}
    {{-- <h3><a href="{{ route('testBooking', ['hotelid' => 1]) }}">Test Booking</a></h3> --}}

    
    {{ $inventory['Basic'] }}
    
    {{-- @dd($inventory) --}}

    <div class="roomTypeCard">
        <div class="typeName">
            <h3>Basic Room</h3>
            <p id="commodities">

            </p>
        </div>

        <div class="numOfGuests">
            <p>1 Adult</p>
        </div>
        
        <div class="price">
            
        </div>
        
        <div class="numOfRooms">
            
        </div>

    </div>
    <div class="roomTypeCard">

    </div>
    <div class="roomTypeCard">

    </div>
    <div class="roomTypeCard">

    </div>





    {{-- <h2>{{$id}}</h2> --}}

    {{-- <h2>{{ $rooms }}</h2> --}}
    {{-- {{$test->count}}
    {{$count}}
    @for ($i = 1; $i < 41; $i++)
        <p>Hotel {{$i}}</p>
        <p>Basic: {{$inventory[$i][1]->count}}</p>
        <p>Couple: {{$inventory[$i][2]->count}}</p>
        <p>Family: {{$inventory[$i][3]->count}}</p>
        <p>Deluxe: {{$inventory[$i][4]->count}}</p>
        <br>
    @endfor --}}

    {{--{{$price}}<br>
     {{$startDate}}<br>
    {{$endDate}}<br>
    {{$duration}}<br> 
    @dd($startDate, $endDate)--}}



    <form action="" method="post">

    </form>





</x-components.common-layout>
