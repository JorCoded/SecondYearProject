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
        <h4>Staff</h4>
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
        <h1 class="">Guest</h1>
        <br><a href="{{ route('login') }}">Sign In</a><br>
    @endauth
    {{-- <br><a href="{{ route('signin') }}">Sign In</a><br> --}}

    {{-- <form action="{{ route('testBooking') }}" method="post">
        @csrf
        <label for="startDate">Start Date</label>
        <input type="date" name="startDate" id="startDate">

        <label for="endDate">End Date</label>
        <input type="date" name="endDate" id="endDate" />

        <button type="submit">Submit</button>
    </form> --}}


    <div id="landing-page-img">
        <div id="landing-page-img1"></div>
        <div id="landing-page-img2"></div>
        <div id="landing-page-img3"></div>
    </div>

    <div id="welcome-msg">
        <h1>Welcome to "website name"</h1>
        <h2></h2>
        <p></p>
    </div>

    <div id="side-navbar">
        <ul>
            <li><a href="#">Destination</a></li>
            <li><a href="#">Start Date</a></li>
            <li><a href="#">End Date</a></li>
            <li><a href="#">Guests</a></li>
        </ul>
    </div>


    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


</x-components.common-layout>
