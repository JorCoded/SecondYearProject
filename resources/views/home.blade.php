<x-components.common-layout>
    <title>Home</title>


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



    {{-- @auth('staff')
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
        
    @endauth --}}
    {{-- <h1 class="">Guest</h1>
        <br><a href="{{ route('login') }}">Sign In</a><br> --}}
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
        <h1><span>Your Choice</span>, The best destinations at lower price!</h1>
        <h2></h2>
        <p></p>

    </div>

    <div id="side-navbar" class="">
        <ul class="nav " id="side-navbar-ul">
            <form action="" class="container" method="get" id="sidebar-form">
                <li class="nav-item mx-2 px-2 rounded-border" id="">
                    <select class="nav-link" name="numOfRooms" id="numOfRooms" required>
                        <option value="" disabled selected hidden>Destination</option>
                        <option value="Hawaii">Hawaii</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Normandy">Normandy</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Spain">Spain</option>
                        <option value="Thailand">Thailand</option>
                    </select>
                </li>
                <li class="nav-item mx-2 px-2 rounded-border" id="startdate-li">
                    <input type="text" placeholder="Select Date" class="nav-link form-control date-input"
                        name="startDate" id="start-date-input" required>

                </li>

                <li class="nav-item justify-content-center mx-2 px-2 rounded-border">
                    <select class="nav-link" name="amountOfPeople" id="amountOfPeople" form="bookingForm">
                        <option value="" disabled selected hidden>Guests</option>
                        <option value="1">Basic (1 person)</option>
                        <option value="2">Couple</option>
                        <option value="3">Family</option>
                        <option value="4">Deluxe (Couple)</option>
                    </select>
                </li>
                {{-- <li class="nav-item mx-2 px-2 rounded-border"> --}}
                <button class="" type="submit" id="side-search-btn">Search</button>
                {{-- </li> --}}
            </form>
        </ul>
    </div>


    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active" id="card-div">
                <div class="d-flex justify-content-around">
                    <div class="card" style="width: 10rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card 1</h5>
                            <p class="card-text">Content description.</p>
                        </div>
                    </div>
                    <div class="card" style="width: 10rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card 2</h5>
                            <p class="card-text">Content description.</p>
                        </div>
                    </div>
                    <div class="card" style="width: 10rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card 3</h5>
                            <p class="card-text">Content description.</p>
                        </div>
                    </div>
                    <!-- Repeat cards for Slide 1 -->
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="d-flex justify-content-around">

                    <div class="card" style="width: 10rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card 4</h5>
                            <p class="card-text">Content description.</p>
                        </div>
                    </div>
                    <div class="card" style="width: 10rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card 5</h5>
                            <p class="card-text">Content description.</p>
                        </div>
                    </div>
                    <div class="card" style="width: 10rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card 6</h5>
                            <p class="card-text">Content description.</p>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="d-flex justify-content-around">

                    <div class="card" style="width: 10rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card 7</h5>
                            <p class="card-text">Content description.</p>
                        </div>
                    </div>
                    <div class="card" style="width: 10rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card 8</h5>
                            <p class="card-text">Content description.</p>
                        </div>
                    </div>
                    <div class="card" style="width: 10rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card 9</h5>
                            <p class="card-text">Content description.</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Additional Slides -->
        </div>
        <button class="carousel-control-prev" id="previous-btn" type="button"
            data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" style="background-color:rgb(161, 161, 161);border-radius:50%;"
                aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" style="background-color:rgb(161, 161, 161);border-radius:50%;"
                aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get today's date in YYYY-MM-DD format
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            const todayStr = `${year}-${month}-${day}`;

            // Set min attribute for start date input
            const startDateInput = document.getElementById('start-date-input');
            if (startDateInput) {
                startDateInput.min = todayStr;

                // When start date changes, update end date min
                startDateInput.addEventListener('change', function() {
                    const endDateInput = document.getElementById('end-date-input');
                    if (endDateInput) {
                        endDateInput.min = this.value;
                        // If end date is before new start date, clear it
                        if (endDateInput.value && endDateInput.value < this.value) {
                            endDateInput.value = '';
                        }
                    }
                });
            }

            // Set min attribute for end date input
            const endDateInput = document.getElementById('end-date-input');
            if (endDateInput) {
                endDateInput.min = todayStr;
            }
        });
    </script>
</x-components.common-layout>
