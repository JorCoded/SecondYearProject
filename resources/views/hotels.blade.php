<x-components.common-layout :user="Auth::guard('customer')->user() ?? Auth::guard('staff')->user()">


    <div id="hotels-div">
    <h1>Hotels</h1>

    <div class="row-container"> <!-- Added this wrapper for the grid -->
        @foreach ($hotels as $hotel)
            <div class="card" style="width: 18rem;">
                <img src="{{ $hotel->picture }}" class="card-img-top" alt="..." style="">
                <div class="card-body row" style="padding:10px;">
                    <h5 class="card-title col" style="margin-bottom: 0px">{{ $hotel->hotel_name }}</h5>
                    {{-- Auth::guard('customer')->user() ?? Auth::guard('staff')->user() --}}
                    @if (Auth::guard('customer')->check() || Auth::guard('staff')->check())
                        <a href="{{ route('book', ['hotelid' => $hotel->id ?? 0, 'custid' => $currentUser->id]) }}">Book
                            Now</a>
                    @else
                        <p class="col-8"><a href="{{ route('login') }}" style="text-decoration: none">Log in to book
                                this hotel</a></p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

    <style>
        #hotels-div {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        #hotels-div h1 {
            text-align: center;
            color: #2d3748;
            margin-bottom: 2rem;
            font-weight: 700;
        }

        /* Creating the Grid */
        #hotels-div .row-container {
            /* Add this wrapper in HTML if possible, or use #hotels-div directly */
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        /* Card Styling */
        .card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            height:auto;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* Image Handling */
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
            /* Ensures image isn't stretched */
        }

        /* Content Area */
        .card-body {
            padding: 1.25rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 9999;
        }

        .card-title {
            font-size: 1.2rem;
            color: #1a202c;
            font-weight: 600;
        }

        /* Links & Buttons */
        .card-body a {
            width: auto
            display: inline-block;
            background-color: #3182ce;
            color: white;
            text-decoration: none;
            padding: 4px 16px;
            border-radius: 6px;
            text-align: center;
            font-weight: 500;
            transition: background 0.2s;
        }

        .card-body a:hover {
            background-color: #2b6cb0;
        }

        /* Login notice styling */
        .card-body p {
            width:max-content;
            font-size: 0.9rem;
            color: #718096;
            margin-top: 10px;
        }
    </style>


</x-components.common-layout>
