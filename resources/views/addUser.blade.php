<x-components.common-layout>
<title>Add User</title>

    <a href="{{ route('home') }}">Home</a><br>
    <a href="{{ route('dashboard') }}">Dashboard</a><br>

    <h1>Add Users</h1>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <a href="?role=staff" id="staffRole"><h2>Staff</h2></a>
    @isset($_GET['role'])
        @if ($_GET['role'] == 'staff')
            <a href="?role=customer" id="customerRole"><h2>Customer</h2></a><br>
            <div id="staff-container">
                <form action="{{ route('storeStaff') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="firstname" id="fname" placeholder="First Name" value="{{ old('firstname') }}"><br>
                    <input type="text" name="lastname" id="lname" placeholder="Last Name" value="{{ old('lastname') }}"><br>
                    <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}"><br>
                    <input type="password" name="password" id="password" placeholder="Password"><br>
                    <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Phone Number" value="{{ old('phoneNumber') }}">
                    <textarea name="address" id="address" cols="30" rows="10" placeholder="Address" value="{{ old('address') }}"></textarea><br>
                    <input type="file" name="profile_pic" id="profile_pic"><br>
                    Date of Birth<br>
                    <input type="date" name="dob" id="dob" placeholder="" value="{{ old('dob') }}"><br>
                    Admin?
                    <label class="switch">
                        <input type="checkbox" name="is_admin">
                        <span class="slider round"></span>
                    </label><br>
                    <button type="submit">Add</button>
                </form>
            
            </div>

        @else
            <style>
                #staffRole{
                    display:none;
                    visibility: hidden;
                }
            </style>
            <div id="customer-container">
                <a href="?role=customer"><h2>Customer</h2></a>
                <a href="?role=staff" ><h2>Staff</h2></a><br>
                <form action="{{ route('storeCustomer') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="firstname" id="fname" placeholder="First Name" value="{{ old('firstname') }}"><br>
                    <input type="text" name="lastname" id="lname" placeholder="Last Name" value="{{ old('lastname') }}"><br>
                    <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}"><br>
                    <input type="password" name="password" id="password" placeholder="Password"><br>
                    <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Phone Number" value="{{ old('phoneNumber') }}">
                    <textarea name="address" id="address" cols="30" rows="10" placeholder="Address" value="{{ old('address') }}"></textarea>
                    <input type="file" name="profile_pic" id="profile_pic"><br>
                    Date of Birth <br>
                    <input type="date" name="dob" id="dob" value="{{ old('dob') }}"><br>
                    <button type="submit">Add</button>
                </form>
            </div>
        @endif
    @endisset
        

    
    

</x-components.common-layout>