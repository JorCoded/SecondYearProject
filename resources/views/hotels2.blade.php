<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Destinations · Bento Grid</title>
  <style>
    /* RESET & GLOBAL */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: #f5f7fb;
      font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
      line-height: 1.5;
      color: #1e1e2a;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 2rem 1.5rem;
    }

    /* MAIN BENTO CONTAINER */
    .destinations-bento {
      max-width: 1280px;
      width: 100%;
      margin: 0 auto;
    }

    /* Breadcrumb */
    .bento-breadcrumb {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 2rem;
      font-size: 0.95rem;
      color: #5b6778;
      letter-spacing: -0.01em;
    }

    .bento-breadcrumb .home {
      color: #6b7a8f;
      text-decoration: none;
      font-weight: 450;
      transition: color 0.15s;
    }

    .bento-breadcrumb .home:hover {
      color: #1f2b3c;
    }

    .bento-breadcrumb .separator {
      color: #b7c0cd;
      font-weight: 300;
    }

    .bento-breadcrumb .current {
      font-weight: 500;
      color: #202937;
    }

    /* ---------- BENTO GRID ---------- */
    .bento-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-auto-rows: minmax(180px, auto);
      gap: 1.5rem;
    }

    /* Every card is a bento tile */
    .bento-card {
      background: #ffffff;
      border-radius: 2rem;
      overflow: hidden;
      box-shadow: 
        0 8px 20px -6px rgba(0, 0, 0, 0.05),
        0 2px 6px rgba(0, 0, 0, 0.02);
      transition: transform 0.2s ease, box-shadow 0.25s ease;
      display: flex;
      flex-direction: column;
      border: 1px solid #f0f2f7;
      text-decoration: none;
      color: inherit;
    }

    .bento-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 18px 30px -10px rgba(18, 35, 60, 0.12), 0 4px 12px rgba(0,0,0,0.03);
      border-color: #e2e8f2;
    }

    /* Card image area */
    .card-image {
      height: 140px;
      background-size: cover;
      background-position: center;
      position: relative;
    }

    .card-image::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 60px;
      background: linear-gradient(to top, rgba(0,0,0,0.3), transparent);
    }

    /* Card content */
    .card-content {
      padding: 1.2rem 1.5rem 1.5rem;
      display: flex;
      flex-direction: column;
      flex-grow: 1;
    }

    .card-label {
      font-size: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: #6d7b8c;
      margin-bottom: 0.4rem;
      font-weight: 500;
    }

    .card-title {
      font-size: 1.4rem;
      font-weight: 650;
      line-height: 1.2;
      margin-bottom: 0.4rem;
      letter-spacing: -0.02em;
      color: #121826;
    }

    .card-destination {
      font-size: 0.9rem;
      color: #4e5b6c;
      display: flex;
      align-items: center;
      gap: 0.4rem;
      margin-top: auto;
    }

    .card-destination .flag {
      font-size: 1.1rem;
    }

    /* Card size variations */
    .span-2-cols {
      grid-column: span 2;
    }

    .span-2-rows {
      grid-row: span 2;
    }

    .span-3-cols {
      grid-column: span 3;
    }

    .tall-card {
      grid-row: span 2;
    }

    /* Larger image for featured cards */
    .bento-card.span-2-cols .card-image,
    .bento-card.tall-card .card-image {
      height: 200px;
    }

    .bento-card.tall-card .card-content {
      padding: 1.5rem 1.8rem 1.8rem;
    }

    .bento-card.tall-card .card-title {
      font-size: 1.8rem;
    }

    /* Wide cards with side-by-side layout */
    .bento-card.span-2-cols .card-content,
    .bento-card.span-3-cols .card-content {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
      padding: 1.5rem;
    }

    .bento-card.span-2-cols .card-text,
    .bento-card.span-3-cols .card-text {
      flex: 1;
    }

    .bento-card.span-2-cols .card-image,
    .bento-card.span-3-cols .card-image {
      width: 45%;
      height: 100%;
      min-height: 180px;
      flex-shrink: 0;
    }

    .bento-card.span-3-cols .card-image {
      width: 40%;
    }

    /* Responsive */
    @media (max-width: 900px) {
      .bento-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1.2rem;
        grid-auto-rows: minmax(160px, auto);
      }
      .span-2-cols, .span-3-cols {
        grid-column: span 2;
      }
      .span-2-rows, .tall-card {
        grid-row: span 1;
      }
      .bento-card.span-2-cols .card-image,
      .bento-card.span-3-cols .card-image {
        width: 100%;
        height: 180px;
      }
      .bento-card.span-2-cols .card-content,
      .bento-card.span-3-cols .card-content {
        flex-direction: column;
        align-items: flex-start;
      }
      body {
        padding: 1.5rem 1rem;
      }
    }

    @media (max-width: 560px) {
      .bento-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
      }
      .span-2-cols, .span-3-cols, .span-2-rows, .tall-card {
        grid-column: span 1;
        grid-row: auto;
      }
      .bento-card.span-2-cols .card-image,
      .bento-card.span-3-cols .card-image {
        width: 100%;
        height: 160px;
      }
    }

    /* ---------- PAGINATION ---------- */
    .pagination-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 0.5rem;
      margin-top: 2.5rem;
      padding: 1rem 0;
    }

    .pagination-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      min-width: 44px;
      height: 44px;
      padding: 0 1rem;
      background: #ffffff;
      border: 1px solid #e2e8f2;
      border-radius: 12px;
      font-size: 0.95rem;
      font-weight: 500;
      color: #4a5568;
      text-decoration: none;
      transition: all 0.2s ease;
      cursor: pointer;
    }

    .pagination-btn:hover:not(.disabled):not(.active) {
      background: #f7fafc;
      border-color: #cbd5e0;
      color: #1a202c;
    }

    .pagination-btn.active {
      background: #1e2b3c;
      color: #ffffff;
      border-color: #1e2b3c;
    }

    .pagination-btn.disabled {
      opacity: 0.4;
      cursor: not-allowed;
      pointer-events: none;
    }

    .pagination-btn.nav {
      font-size: 1.2rem;
    }

    .pagination-info {
      margin-left: 1rem;
      font-size: 0.9rem;
      color: #6b7a8f;
    }

    /* Cards counter */
    .cards-counter {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
      padding: 0 0.25rem;
    }

    .cards-counter-text {
      font-size: 0.9rem;
      color: #6d7b8c;
    }
  </style>
</head>
<body>
  <div class="destinations-bento">
    <!-- Breadcrumb -->
    <div class="bento-breadcrumb">
      <a href="{{ route('home') }}" class="home">Home</a>
      <span class="separator">›</span>
      <span class="current">Destinations</span>
    </div>

    <!-- Cards counter -->
    <div class="cards-counter">
      <span class="cards-counter-text">
        Showing {{ $startItem }} - {{ $endItem }} of {{ $totalCards }} destinations
      </span>
    </div>

    <!-- BENTO GRID - 10 cards per page with varied sizes -->
    <div class="bento-grid">

      {{-- Card 1: Featured (span 2 cols, 2 rows) - Large hero card --}}
      <a href="{{ $cards[0]['url'] }}" class="bento-card tall-card">
        <div class="card-image" style="background-image: url('{{ $cards[0]['image'] }}');"></div>
        <div class="card-content">
          <span class="card-label">{{ $cards[0]['label'] }}</span>
          <div class="card-title">{{ $cards[0]['title'] }}</div>
          <div class="card-destination">
            <span class="flag">{{ $cards[0]['flag'] }}</span>
            {{ $cards[0]['destination'] }}
          </div>
        </div>
      </a>

      {{-- Card 2: Standard card --}}
      <a href="{{ $cards[1]['url'] }}" class="bento-card">
        <div class="card-image" style="background-image: url('{{ $cards[1]['image'] }}');"></div>
        <div class="card-content">
          <span class="card-label">{{ $cards[1]['label'] }}</span>
          <div class="card-title">{{ $cards[1]['title'] }}</div>
          <div class="card-destination">
            <span class="flag">{{ $cards[1]['flag'] }}</span>
            {{ $cards[1]['destination'] }}
          </div>
        </div>
      </a>

      {{-- Card 3: Wide card (span 2 cols) --}}
      <a href="{{ $cards[2]['url'] }}" class="bento-card span-2-cols">
        <div class="card-image" style="background-image: url('{{ $cards[2]['image'] }}');"></div>
        <div class="card-content">
          <div class="card-text">
            <span class="card-label">{{ $cards[2]['label'] }}</span>
            <div class="card-title">{{ $cards[2]['title'] }}</div>
            <div class="card-destination">
              <span class="flag">{{ $cards[2]['flag'] }}</span>
              {{ $cards[2]['destination'] }}
            </div>
          </div>
        </div>
      </a>

      {{-- Card 4: Standard card --}}
      <a href="{{ $cards[3]['url'] }}" class="bento-card">
        <div class="card-image" style="background-image: url('{{ $cards[3]['image'] }}');"></div>
        <div class="card-content">
          <span class="card-label">{{ $cards[3]['label'] }}</span>
          <div class="card-title">{{ $cards[3]['title'] }}</div>
          <div class="card-destination">
            <span class="flag">{{ $cards[3]['flag'] }}</span>
            {{ $cards[3]['destination'] }}
          </div>
        </div>
      </a>

      {{-- Card 5: Standard card --}}
      <a href="{{ $cards[4]['url'] }}" class="bento-card">
        <div class="card-image" style="background-image: url('{{ $cards[4]['image'] }}');"></div>
        <div class="card-content">
          <span class="card-label">{{ $cards[4]['label'] }}</span>
          <div class="card-title">{{ $cards[4]['title'] }}</div>
          <div class="card-destination">
            <span class="flag">{{ $cards[4]['flag'] }}</span>
            {{ $cards[4]['destination'] }}
          </div>
        </div>
      </a>

      {{-- Card 6: Tall card (span 2 rows) --}}
      <a href="{{ $cards[5]['url'] }}" class="bento-card span-2-rows">
        <div class="card-image" style="background-image: url('{{ $cards[5]['image'] }}'); height: 100%;"></div>
        <div class="card-content">
          <span class="card-label">{{ $cards[5]['label'] }}</span>
          <div class="card-title">{{ $cards[5]['title'] }}</div>
          <div class="card-destination">
            <span class="flag">{{ $cards[5]['flag'] }}</span>
            {{ $cards[5]['destination'] }}
          </div>
        </div>
      </a>

      {{-- Card 7: Standard card --}}
      <a href="{{ $cards[6]['url'] }}" class="bento-card">
        <div class="card-image" style="background-image: url('{{ $cards[6]['image'] }}');"></div>
        <div class="card-content">
          <span class="card-label">{{ $cards[6]['label'] }}</span>
          <div class="card-title">{{ $cards[6]['title'] }}</div>
          <div class="card-destination">
            <span class="flag">{{ $cards[6]['flag'] }}</span>
            {{ $cards[6]['destination'] }}
          </div>
        </div>
      </a>

      {{-- Card 8: Wide card (span 2 cols) --}}
      <a href="{{ $cards[7]['url'] }}" class="bento-card span-2-cols">
        <div class="card-image" style="background-image: url('{{ $cards[7]['image'] }}');"></div>
        <div class="card-content">
          <div class="card-text">
            <span class="card-label">{{ $cards[7]['label'] }}</span>
            <div class="card-title">{{ $cards[7]['title'] }}</div>
            <div class="card-destination">
              <span class="flag">{{ $cards[7]['flag'] }}</span>
              {{ $cards[7]['destination'] }}
            </div>
          </div>
        </div>
      </a>

      {{-- Card 9: Standard card --}}
      <a href="{{ $cards[8]['url'] }}" class="bento-card">
        <div class="card-image" style="background-image: url('{{ $cards[8]['image'] }}');"></div>
        <div class="card-content">
          <span class="card-label">{{ $cards[8]['label'] }}</span>
          <div class="card-title">{{ $cards[8]['title'] }}</div>
          <div class="card-destination">
            <span class="flag">{{ $cards[8]['flag'] }}</span>
            {{ $cards[8]['destination'] }}
          </div>
        </div>
      </a>

      {{-- Card 10: Standard card --}}
      <a href="{{ $cards[9]['url'] }}" class="bento-card">
        <div class="card-image" style="background-image: url('{{ $cards[9]['image'] }}');"></div>
        <div class="card-content">
          <span class="card-label">{{ $cards[9]['label'] }}</span>
          <div class="card-title">{{ $cards[9]['title'] }}</div>
          <div class="card-destination">
            <span class="flag">{{ $cards[9]['flag'] }}</span>
            {{ $cards[9]['destination'] }}
          </div>
        </div>
      </a>

    </div><!-- end bento-grid -->

    {{-- PAGINATION --}}
    <div class="pagination-wrapper">
      {{-- Previous page link --}}
      @if($currentPage > 1)
        <a href="{{ route('destinations.index', ['page' => $currentPage - 1]) }}" class="pagination-btn nav">
          ‹
        </a>
      @else
        <span class="pagination-btn nav disabled">‹</span>
      @endif

      {{-- Page numbers --}}
      @foreach($paginationRange as $page)
        @if($page == '...')
          <span class="pagination-btn disabled">...</span>
        @else
          <a href="{{ route('destinations.index', ['page' => $page]) }}" 
             class="pagination-btn {{ $page == $currentPage ? 'active' : '' }}">
            {{ $page }}
          </a>
        @endif
      @endforeach

      {{-- Next page link --}}
      @if($currentPage < $totalPages)
        <a href="{{ route('destinations.index', ['page' => $currentPage + 1]) }}" class="pagination-btn nav">
          ›
        </a>
      @else
        <span class="pagination-btn nav disabled">›</span>
      @endif

      <span class="pagination-info">Page {{ $currentPage }} of {{ $totalPages }}</span>
    </div>

  </div><!-- end destinations-bento -->
</body>
</html>
