<x-components.common-layout :user="Auth::guard('customer')->user() ?? Auth::guard('staff')->user()">
    <h1>Booking Details</h1>

    <form method="POST" action="{{route('getDetails',['hotelid' => $hotelid,'custid' => $currentUser->id])}}">
        @csrf
        <label for="startDate">Select Date</label>
        <input type="text" placeholder="Select Date" class="nav-link form-control date-input"
                        name="startDate" id="start-date-input" required>

        <label for="amountOfPeople">Number of people:</label>
        <select name="amountOfPeople" id="amountOfPeople" form="bookingForm">
            <option value="1">Basic (1 person)</option>
            <option value="2">Couple</option>
            <option value="3">Family</option>
            <option value="4">Deluxe (Couple)</option>
        </select>


     
        <label for="numOfRooms">How many rooms do you want?</label>
        <!-- <input type="number" name="numOfRooms" id="numberOfRooms"> -->
         <select name="numOfRooms" id="numOfRooms">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
         </select>

        <button type="submit" name='reserve'>Reserve</button>
    </form>

</x-components.common-layout>
