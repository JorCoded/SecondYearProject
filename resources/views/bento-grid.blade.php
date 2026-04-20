<x-components.common-layout>
     <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        main{
            padding-left:10px;
            padding-right:10px;
        }
        

        /* Bento wrapper – only the destinations area (no header/footer) */
        .bento-destinations {
            max-width: 1280px;
            width: 100%;
            margin-top:100px;
            margin-bottom: 50px;
        }

        /* Breadcrumb / micro label – matches "Home > Destinations" wireframe */
        .destinations-label {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 24px;
            font-size: 0.95rem;
            color: #5b6778;
            font-weight: 500;
            letter-spacing: -0.01em;
        }

        .destinations-label .home {
            color: #6f7c8c;
        }

        .destinations-label .separator {
            color: #b1b9c6;
            font-weight: 300;
            font-size: 1.1rem;
            line-height: 1;
        }

        .destinations-label .current {
            color: #1e2b3c;
            font-weight: 600;
        }

        /* ---------- BENTO GRID ---------- */
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            grid-auto-rows: minmax(140px, auto);
        }

        /* All bento cards share this soft, elevated style */
        .bento-card {
            background: #ffffff;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03), 0 8px 16px -6px rgba(0, 0, 0, 0.05);
            transition: transform 0.25s ease, box-shadow 0.3s ease;
            border: 1px solid #f0f3f7;
            display: flex;
            flex-direction: column;
            text-decoration: none;
        }

        .bento-card:hover {
            box-shadow: 0 20px 30px -10px rgba(0, 20, 40, 0.08);
            transform: translateY(-2px);
            border-color: #e0e8f0;
        }

        /* image cards – full bleed image with overlay text */
        .card-image {
            background-size: cover;
            background-position: center 30%;
            position: relative;
            padding: 0;
            overflow: hidden;
            justify-content: flex-end;
            min-height: 200px;
            flex-grow: 1;
        }

        .card-image::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.45) 0%, rgba(0,0,0,0.1) 50%, transparent 80%);
            border-radius: 28px;
            z-index: 1;
            transition: background 0.3s ease;
        }

        .bento-card:hover .card-image::before {
            background: linear-gradient(to top, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.15) 50%, transparent 80%);
        }

        .card-image .card-content {
            position: relative;
            z-index: 2;
            color: white;
            padding: 1.4rem 1.4rem 1.2rem;
            margin-top: auto;
            text-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        .card-image .destination-name {
            font-size: 1.6rem;
            font-weight: 600;
            letter-spacing: -0.02em;
            line-height: 1.2;
            margin-bottom: 6px;
            font-family: 'Poppins', sans-serif;
        }

        .card-image .country {
            font-size: 0.9rem;
            font-weight: 500;
            opacity: 0.9;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* grid placement variations (bento style) */
        .span-2 {
            grid-column: span 2;
        }

        .span-row-2 {
            grid-row: span 2;
        }

        .tall-card {
            grid-row: span 2;
        }

        /* make grid responsive */
        @media (max-width: 900px) {
            .bento-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .span-2 {
                grid-column: span 1;
            }
            .tall-card {
                grid-row: span 1;
            }
        }

        @media (max-width: 560px) {
            .bento-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

<div class="bento-destinations">
    

    <!-- Bento grid – clean & playful layout with 10 cards -->
    <div class="bento-grid">

        {{-- Card 1: Featured - Kyoto (span 2 columns, tall) --}}
        <a href="{{-- {{ route('destinations.show', ['slug' => 'kyoto']) }} --}}" class="bento-card card-image bg-kyoto span-2 tall-card">
            <div class="card-content">
                <div class="destination-name">Kyoto</div>
                <div class="country">
                    <span>🇯🇵 Japan</span>
                </div>
            </div>
        </a>

        {{-- Card 2: Santorini --}}
        <a href="{{-- {{ route('destinations.show', ['slug' => 'santorini']) }} --}}" class="bento-card card-image bg-santorini">
            <div class="card-content">
                <div class="destination-name" style="font-size: 1.4rem;">Santorini</div>
                <div class="country">🇬🇷 Greece</div>
            </div>
        </a>

        {{-- Card 3: Swiss Alps --}}
        <a href="{{-- {{ route('destinations.show', ['slug' => 'swiss-alps']) }} --}}" class="bento-card card-image bg-alps">
            <div class="card-content">
                <div class="destination-name" style="font-size: 1.3rem;">Swiss Alps</div>
                <div class="country">🇨🇭 Switzerland</div>
            </div>
        </a>

        {{-- Card 4: Bali --}}
        <a href="{{-- {{ route('destinations.show', ['slug' => 'bali']) }} --}}" class="bento-card card-image bg-bali">
            <div class="card-content">
                <div class="destination-name" style="font-size: 1.3rem;">Bali</div>
                <div class="country">🇮🇩 Indonesia</div>
            </div>
        </a>

        {{-- Card 5: Paris (span 2 columns) --}}
        <a href="{{-- {{ route('destinations.show', ['slug' => 'paris']) }} --}}" class="bento-card card-image bg-paris span-2">
            <div class="card-content">
                <div class="destination-name" style="font-size: 1.4rem;">Paris</div>
                <div class="country">🇫🇷 France</div>
            </div>
        </a>

        {{-- Card 6: New York --}}
        <a href="{{-- {{ route('destinations.show', ['slug' => 'new-york']) }} --}}" class="bento-card card-image bg-newyork">
            <div class="card-content">
                <div class="destination-name" style="font-size: 1.3rem;">New York</div>
                <div class="country">🇺🇸 United States</div>
            </div>
        </a>

        {{-- Card 7: Maldives --}}
        <a href="{{-- {{ route('destinations.show', ['slug' => 'maldives']) }} --}}" class="bento-card card-image bg-maldives">
            <div class="card-content">
                <div class="destination-name" style="font-size: 1.3rem;">Maldives</div>
                <div class="country">🇲🇻 Maldives</div>
            </div>
        </a>

        {{-- Card 8: Dubai --}}
        <a href="{{-- {{ route('destinations.show', ['slug' => 'dubai']) }} --}}" class="bento-card card-image bg-dubai">
            <div class="card-content">
                <div class="destination-name" style="font-size: 1.3rem;">Dubai</div>
                <div class="country">🇦🇪 United Arab Emirates</div>
            </div>
        </a>

        {{-- Card 9: Machu Picchu --}}
        <a href="{{-- {{ route('destinations.show', ['slug' => 'machu-picchu']) }} --}}" class="bento-card card-image bg-machu">
            <div class="card-content">
                <div class="destination-name" style="font-size: 1.3rem;">Machu Picchu</div>
                <div class="country">🇵🇪 Peru</div>
            </div>
        </a>

        {{-- Card 10: Barcelona --}}
        <a href="{{-- {{ route('destinations.show', ['slug' => 'barcelona']) }} --}}" class="bento-card card-image bg-barcelona">
            <div class="card-content">
                <div class="destination-name" style="font-size: 1.3rem;">Barcelona</div>
                <div class="country">🇪🇸 Spain</div>
            </div>
        </a>

    </div>

    <!-- subtle extra: we can add a tiny "bento hint" – no header/footer, exactly as requested -->
    <div style="margin-top: 12px; opacity: 0.5; font-size: 0.7rem; text-align: right; color: #8a99aa;">
        <!-- wireframe inspired · bento grid -->
    </div>
</div>
</x-components.common-layout>