<div>
    <form action="{{route('/payment',['bookingRequest'=> $bookingRequest, 'custid'=> $user->id, 'hotelid' => $hotel->id])}}" method="post">
        @csrf

    </form>
</div>
