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

        <label for="">How many rooms do you want?</label>
        <input type="number" name="numOfRooms" id="numberOfRooms">

    </form>
</body>
</html>
<?php
    $list=[
        "key1"=>"value1",
        "key2"=>"value2",
    ];

    $lists=[];

    array_push($lists, [$list["key1"]="val2", $list["key2"]="val2"]);

    array_pop($list)
?>