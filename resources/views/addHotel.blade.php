<x-components.common-layout>

    <a href="{{ route('home') }}">Home</a><br>
    <a href="{{ route('dashboard') }}">Dashboard</a><br>

    <div id="addHotel-div">
        <h1>Add Hotel</h1><br>

        <form action="{{ route('storeHotel') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="hotel_name" id="hotel-name" placeholder="Hotel Name"><br>
            <textarea name="description" id="description" cols="30" rows="10" placeholder="Description"></textarea><br>
            <input type="text" name="location" id="location" placeholder="Location"><br>
            <input type="text" name="address" id="address" placeholder="Address"><br>
            <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Phone Number"><br>
            <input type="email" name="email" id="email" placeholder="Email"><br>
            Upload Picture<br>
            <input type="file" name="picture" id="picture"><br>{{-- Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odit quibusdam voluptates fuga maiores nemo laborum, alias commodi molestiae id expedita fugit repellendus. Ex porro aliquam laborum exercitationem hic! Eos, dolores possimus! Ut nam nihil et reiciendis cumque iste neque, voluptate corporis eius excepturi maxime ipsam optio? Ea reprehenderit laboriosam quia, vel laborum, exercitationem neque eius est ab in voluptatum sunt. Rem dicta, magnam sequi nam consequatur optio pariatur minus quis in consectetur voluptas dolorem quas molestiae animi dignissimos? Exercitationem eaque voluptatum vel porro deserunt ullam illo iure quisquam ipsum nulla odio suscipit accusantium magni, fugit perspiciatis, ut, expedita maxime pariatur? --}}
            <button type="submit">Add Hotel</button>
        </form>
    </div>

    {{-- <form action="{{ route('uploadImage') }}" method="post" enctype="multipart/form-data">
        <input type="file" name="picture" id="picture">
        <button type="submit">Upload</button>
    </form> --}}

</x-components.common-layout>