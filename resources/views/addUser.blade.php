<x-components.common-layout>
<title>Add User</title>

    <a href="{{ route('home') }}">Home</a><br>
    <a href="{{ route('dashboard') }}">Dashboard</a><br>

    <h1>Add Staff</h1>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

            
            <div id="staff-container">
                <form id="staffForm" action="{{ route('storeStaff') }}" method="post" enctype="multipart/form-data">
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

       
        
<style>
    /* Page title */
    h1 {
        font-size: 28px;
        color: #1a1a1a;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #1976d2;
    }
    
    /* Navigation links */
    a {
        display: inline-block;
        color: #1976d2;
        text-decoration: none;
        font-size: 14px;
        margin-right: 15px;
        margin-bottom: 15px;
        padding: 5px 0;
        transition: color 0.2s ease;
    }
    
    a:hover {
        color: #1565c0;
        text-decoration: underline;
    }
    
    /* Error messages */
    
    
    
    
    /* Form container */
    #staff-container {
        max-width: 500px;
        margin-top: 20px;
    }
    
    /* Form elements */
    #staffForm {
        background: #f9f9f9;
        padding: 25px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
    }
    
    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="date"],
    textarea {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        box-sizing: border-box;
        transition: border-color 0.3s ease;
    }
    
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus,
    input[type="date"]:focus,
    textarea:focus {
        outline: none;
        border-color: #1976d2;
        box-shadow: 0 0 0 2px rgba(25, 118, 210, 0.1);
    }
    
    textarea {
        resize: vertical;
        min-height: 80px;
        font-family: inherit;
    }
    
    input[type="file"] {
        margin-bottom: 15px;
        font-size: 14px;
    }
    
    /* Toggle switch */
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 26px;
        margin-left: 10px;
        vertical-align: middle;
    }
    
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.3s;
        border-radius: 26px;
    }
    
    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: 0.3s;
        border-radius: 50%;
    }
    
    input:checked + .slider {
        background-color: #1976d2;
    }
    
    input:checked + .slider:before {
        transform: translateX(24px);
    }
    
    /* Submit button */
    button[type="submit"] {
        width: 100%;
        padding: 12px;
        background: #1976d2;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 10px;
        transition: background 0.3s ease;
    }
    
    button[type="submit"]:hover {
        background: #1565c0;
    }
    
    button[type="submit"]:active {
        transform: scale(0.98);
    }
    
    /* Labels styling */
    form {
        color: #333;
        font-size: 14px;
    }
    
    br {
        display: block;
        content: "";
        margin-top: 5px;
    }
</style>
    
    

</x-components.common-layout>