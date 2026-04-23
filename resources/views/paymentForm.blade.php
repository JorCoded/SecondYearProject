<x-components.common-layout>
    <div>
        <form
            action="{{ route('processPayment', [/* 'bookingRequest' => $bookingRequest,  */'hotelid' => $hotelid]) }}"
            method="post">
            @csrf


            {{-- start date - end date --}}
            <h3>{{ $startDate }} to {{ $endDate }}</h3>
            {{-- duration --}}
            <h3>{{ $duration }} Night(s)</h3>
            {{-- hotel name --}}

            {{-- room type and price --}}
            <h3>Room Type: {{ $roomType }}, Price: {{ $price }}</h3>
            {{-- number of rooms --}}
            <h3>Number of rooms: {{ $rooms }}</h3>

            {{-- total price --}}
            <h3>Total Price: {{ $totalPrice }} Mur</h3>

            <input type="hidden" name="amountOfPeople" value="{{ $amountOfPeople }}">
            <input type="hidden" name="numOfRooms" value="{{ $rooms }}">


            <div id="creditCardDiv" class="reveal-if-active"
                style="margin-top:10px; padding:10px;border:1px solid #ccc;">

                <label for="country">Country</label>
                <select name="country" id="country">
                    <option value="Mauritius" selected>Mauritius</option>
                    <option value="United States">United States</option>
                    <option value="Canada">Canada</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Other">Other</option>
                </select><br>

                <label for="cardNum">Credit Card Number</label>
                <input type="text" name="cardNum" id="cardNum"><br>

                <label for="expDate">Expiration Date</label>
                <input type="text" name="expMonth" id="expMonth" placeholder="mm" style="width: 40px"> /
                <input type="text" name="expYear" id="expYear" placeholder="yy" style="width: 40px"><br>

                <label for="csc">CSC</label>
                <input type="text" name="csc" id="csc">

            </div>

            {{-- Confirm button --}}
            <button>Confirm</button>
        </form>
    </div>
</x-components.common-layout>
