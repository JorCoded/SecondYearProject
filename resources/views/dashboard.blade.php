<x-components.common-layout>
    
    <h1>Dashboard</h1>
    <a href="{{ route('users') }}">Users</a><br>
    <a href="{{ route('hotels') }}">Hotels</a><br>
    <a href="{{ route('home') }}">Home</a><br>

    <form action="{{ route('testBooking', ['hotelid' => 1, 'typeid'=>1]) }}" method="post">
        @csrf
        
    </form>

    {{-- <a href="{{ route('testBooking', ['hotelid' => 1, 'typeid'=>1]) }}">Test Booking</a><br> --}}
    <a href="{{ route('test') }}">Test Booking</a><br>

    {{-- {{ echo $picture; }} --}}
</x-components.common-layout>