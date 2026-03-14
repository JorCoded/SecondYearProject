<x-components.common-layout>
    <div id="customer-div">
        <h2>Customers</h2>

        @foreach ($customers as $customer)
            <p><h3>{{ $customer->firstname . ' ' . $customer->lastname}}</h3> {{ $customer->email }}  <a href="/deleteUser">Delete</a></p><br>
        @endforeach
        <br>
    </div>

    <div id="staff-div">
        <h1>Staff</h1>

        @foreach ($staff as $staffUser)
            <p><h3>{{$staffUser->firstname . ' ' . $staffUser->lastname}}</h3> {{ $staffUser->email }} {{$staffUser->is_admin ? 'Admin' : 'Not Admin'}}. <a href="/makeAdmin">Make Admin</a> <a href="/deleteUser">Delete</a></p><br>
        @endforeach
        <br>
    </div>

    <style>
        #testImg{
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
    </style>
    {{-- <img id="testImg" src="public\media\customerPictures\phpF7FC.tmp" alt=""> --}}
    
    <a href="{{ route('dashboard') }}">Dashboard</a><br><br>

    <a href="{{ route('addUser') }}">Add User</a>
</x-components.common-layout>