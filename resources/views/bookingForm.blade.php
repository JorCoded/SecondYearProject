<x-components.common-layout>
    <h1>Booking Details</h1>

    <form action="{{route('getDetails',['hotelid' => $hotel->id,'custid' => $user->id])}}">
        @csrf
        <label for="startDate">Start Date</label>
        <input type="date" name="startDate" id="startDate">

        <label for="endDate">End Date</label>
        <input type="date" name="endDate" id="endDate">

        <label for="amountOfPeople">Number of people:</label>
        <select name="amountOfPeople" id="amountOfPeople" form="bookingForm">
            <option value="1">Basic (1 person)</option>
            <option value="2">Couple</option>
            <option value="3">Family</option>
            <option value="4">Deluxe (Couple)</option>
        </select>

        <table>
            <thead>
                <tr>
                    <th>Room Type</th>
                    <th>Number of Guests</th>
                    <th>Price for  Nights</th>
                    <th>Number of Rooms</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                
            </tbody>
        </table>

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
