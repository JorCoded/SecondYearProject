<x-components.common-layout>
    <title>Home</title>

    <h1>Home</h1>

    {{-- @if (Auth::guard('customer')->check() || Auth::guard('staff')->check())
     Hello {{ Auth::guard('staff')->user()->firstname}} 
     <br><a href="{{ route('logout')}}">Log out</a>


    @else
        <a href="{{ route('dashboard') }}">Dashboard</a><br>
        <a href="{{ route('signin') }}">Sign In</a><br>
        <a href="{{ route('logout')}}">Log out</a>
    @endif 

    @auth('staff')
        Hello {{$user->firstname}}

        @if ($user->is_admin)
            <br><a href="{{ route('dashboard') }}">Dashboard</a>
        @endif
        
        <br><a href="{{ route('logout')}}">Log out</a>
    @endauth

    @auth('customer')
        Hello {{$user->firstname}}
        <br><a href="{{ route('logout')}}">Log out</a>
    @endauth --}}



    @auth('staff')
        Hello {{ auth()->guard('staff')->user()->firstname }}

        @if (auth()->guard('staff')->user()->is_admin)
            <br><a href="{{ route('dashboard') }}">Dashboard</a><br>
        @endif

        <a href="{{ route('hotels') }}">Hotels</a><br>

        <br><a href="{{ route('logout') }}">Log out</a>
    @elseauth('customer')
        <h1>Customer</h1>
        Hello {{ auth()->guard('customer')->user()->firstname }}
        <a href="{{ route('hotels') }}">Hotels</a><br>
        <br><a href="{{ route('logout') }}">Log out</a>
    @else
        <h1>Guest</h1>
        <br><a href="{{ route('signin') }}">Sign In</a><br>
    @endauth
    {{-- <br><a href="{{ route('signin') }}">Sign In</a><br> --}}

    <form action="{{ route('testBooking') }}" method="post">
        @csrf
        <label for="startDate">Start Date</label>
        <input type="date" name="startDate" id="startDate">

        <label for="endDate">End Date</label>
        <input type="date" name="endDate" id="endDate" />

        <button type="submit">Submit</button>
    </form>

</x-components.common-layout>
