<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action=" {{ route('', ['hotelid' => 1, 'typeid'=>1]) }} " method="post" id="bookingForm">
        <h3>Booking Form</h3>

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
</body>
</html>
<?php
    $list=[
        "key1"=>"value1",
        "key2"=>"value2",
    ];

    $lists=[];
    $str = "";
    explode($str,"-");
    array_push($lists, [$list["key1"]="val2", $list["key2"]="val2"]);
    
    array_pop($list)
?>