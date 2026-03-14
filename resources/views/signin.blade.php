<x-components.common-layout>
    
    <a href="{{ route('home') }}">Home</a><br>
    <a href="{{ route('dashboard') }}">Dashboard</a><br>

    <div id="signUp-div">
        <h1>Sign Up</h1>
        <form action="{{ route('signUp') }}" method="post">
            @csrf
            <input type="text" name="firstname" id="fname" placeholder="First Name" value="{{ old('firstname') }}"><br>
            @error('firstname')
                <span id="fnameError" role="alert">{{$message}}</span>
            @enderror
                
            <input type="text" name="lastname" id="lname" placeholder="Last Name" value="{{ old('lastname') }}"><br>
            @error('lastname')
                <span id="lnameError" role="alert">{{$message}}</span>
            @enderror

            <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}"><br>
            @error('email')
                <span id="emailError" role="alert">{{ $message }}</span>
            @enderror

            <input type="password" name="password" id="password" placeholder="Password"><br>
            @error('password')  
                <span id="passwordError" role="alert">{{ $message }}</span>
            @enderror

            <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Phone Number" value="{{ old('phoneNumber') }}">
            @error('phoneNumber')
                <span id="phoneNumberError" role="alert">{{ $message }}</span>
            @enderror
            
            <input type="text" name="credCardNum" id="credCardNum" placeholder="Credit Card Number">
            @error('credCardNum')
                <span id="credCardNumError" role="alert">{{ $message }}</span>
            @enderror
                
            <textarea name="address" id="address" cols="30" rows="10" placeholder="Address" value="{{ old('address') }}"></textarea><br>
            @error('address')
                <span id="addressError" role="alert">{{ $message }}</span>
            @enderror
            
            <input type="file" name="profile_pic" id="profile_pic"><br>
            Date of Birth <br>
            <input type="date" name="dob" id="dob" value="{{ old('dob') }}"><br>
            @error('dob')
                <span id="dobError">{{ $message }}</span>
            @enderror
            
            <button type="submit">Sign Up</button>
        </form>
        <br>
    </div>

    <div id="logIn-div">
        <h1>Log In</h1>
        <form action="{{ route('signIn') }}" method="post">
            @csrf
            <input type="email" name="email" id="email" placeholder="Email"><br>
            @error('email')
                <span id="emailError" role="alert">{{ $message }}</span>
            @enderror
            
            <input type="password" name="password" id="password" placeholder="Password"><br>
            @error('password')
                <span id="passwordError" role="alert">{{ $message }}</span>
            @enderror

            {{-- <input type="password" name="password_confirmation" id="password" placeholder="Confirm Password"><br>
            @error('password_confirmation')
                <span id="passwordError" role="alert">{{ $message }}</span>
            @enderror --}}
            
            <button type="submit">Log In</button>
        </form>
    </div>
{{-- Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas libero adipisci eius id aliquid in aliquam repellendus iste fugiat, nulla ipsa nam excepturi blanditiis quam a molestiae quae, reiciendis vitae nihil doloremque, quia qui? Deleniti qui aut doloribus perferendis sint facere quidem obcaecati est neque quaerat, rerum consequuntur. Quo architecto, dolore, possimus aliquid asperiores facilis saepe libero incidunt harum minus odio ad doloribus neque, nulla culpa nemo cupiditate! Praesentium modi odio at deserunt nobis laborum sint delectus excepturi laboriosam deleniti dicta quis enim quam labore repellendus iusto obcaecati eos, blanditiis, ducimus vel consectetur atque aspernatur quibusdam adipisci! Pariatur, in error. --}}
</x-components.common-layout>
