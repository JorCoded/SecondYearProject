<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DestinationsController extends Controller
{
    /**
     * Display a paginated bento grid of destinations.
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // All 40 destination cards with placeholder data
        $allCards = $this->generateDestinations();
        
        // Pagination settings
        $perPage = 10;
        $currentPage = $request->get('page', 1);
        $totalCards = count($allCards);
        $totalPages = ceil($totalCards / $perPage);
        
        // Ensure current page is valid
        $currentPage = max(1, min($currentPage, $totalPages));
        
        // Get cards for current page
        $offset = ($currentPage - 1) * $perPage;
        $cards = array_slice($allCards, $offset, $perPage);
        
        // Calculate display range
        $startItem = $offset + 1;
        $endItem = min($offset + $perPage, $totalCards);
        
        // Generate pagination range
        $paginationRange = $this->generatePaginationRange($currentPage, $totalPages);
        
        return view('destinations', [
            'cards' => $cards,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'totalCards' => $totalCards,
            'startItem' => $startItem,
            'endItem' => $endItem,
            'paginationRange' => $paginationRange,
        ]);
    }
    
    /**
     * Generate 40 destination cards with placeholder data.
     * 
     * @return array
     */
    private function generateDestinations()
    {
        $destinations = [
            // Cards 1-10 (Page 1)
            [
                'label' => 'Featured',
                'title' => 'Kyoto',
                'destination' => 'Japan',
                'flag' => '🇯🇵',
                'image' => 'https://images.pexels.com/photos/402028/pexels-photo-402028.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'kyoto']),
            ],
            [
                'label' => 'Popular',
                'title' => 'Santorini',
                'destination' => 'Greece',
                'flag' => '🇬🇷',
                'image' => 'https://images.pexels.com/photos/1619299/pexels-photo-1619299.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'santorini']),
            ],
            [
                'label' => 'Trending',
                'title' => 'Swiss Alps',
                'destination' => 'Switzerland',
                'flag' => '🇨🇭',
                'image' => 'https://images.pexels.com/photos/552785/pexels-photo-552785.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'swiss-alps']),
            ],
            [
                'label' => 'Beach',
                'title' => 'Bali',
                'destination' => 'Indonesia',
                'flag' => '🇮🇩',
                'image' => 'https://images.pexels.com/photos/2166553/pexels-photo-2166553.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'bali']),
            ],
            [
                'label' => 'Romantic',
                'title' => 'Paris',
                'destination' => 'France',
                'flag' => '🇫🇷',
                'image' => 'https://images.pexels.com/photos/3671143/pexels-photo-3671143.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'paris']),
            ],
            [
                'label' => 'Adventure',
                'title' => 'Machu Picchu',
                'destination' => 'Peru',
                'flag' => '🇵🇪',
                'image' => 'https://images.pexels.com/photos/2357349/pexels-photo-2357349.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'machu-picchu']),
            ],
            [
                'label' => 'City',
                'title' => 'New York',
                'destination' => 'United States',
                'flag' => '🇺🇸',
                'image' => 'https://images.pexels.com/photos/466685/pexels-photo-466685.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'new-york']),
            ],
            [
                'label' => 'Luxury',
                'title' => 'Dubai',
                'destination' => 'UAE',
                'flag' => '🇦🇪',
                'image' => 'https://images.pexels.com/photos/8197647/pexels-photo-8197647.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'dubai']),
            ],
            [
                'label' => 'Island',
                'title' => 'Maldives',
                'destination' => 'Maldives',
                'flag' => '🇲🇻',
                'image' => 'https://images.pexels.com/photos/1450353/pexels-photo-1450353.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'maldives']),
            ],
            [
                'label' => 'Culture',
                'title' => 'Barcelona',
                'destination' => 'Spain',
                'flag' => '🇪🇸',
                'image' => 'https://images.pexels.com/photos/1388030/pexels-photo-1388030.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'barcelona']),
            ],
            
            // Cards 11-20 (Page 2)
            [
                'label' => 'Historic',
                'title' => 'Rome',
                'destination' => 'Italy',
                'flag' => '🇮🇹',
                'image' => 'https://images.pexels.com/photos/1549326/pexels-photo-1549326.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'rome']),
            ],
            [
                'label' => 'Nature',
                'title' => 'Banff',
                'destination' => 'Canada',
                'flag' => '🇨🇦',
                'image' => 'https://images.pexels.com/photos/2007401/pexels-photo-2007401.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'banff']),
            ],
            [
                'label' => 'Wilderness',
                'title' => 'Iceland',
                'destination' => 'Iceland',
                'flag' => '🇮🇸',
                'image' => 'https://images.pexels.com/photos-2321439/pexels-photo-2321439.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'iceland']),
            ],
            [
                'label' => 'Tropical',
                'title' => 'Thailand',
                'destination' => 'Thailand',
                'flag' => '🇹🇭',
                'image' => 'https://images.pexels.com/photos/2187605/pexels-photo-2187605.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'thailand']),
            ],
            [
                'label' => 'Safari',
                'title' => 'Serengeti',
                'destination' => 'Tanzania',
                'flag' => '🇹🇿',
                'image' => 'https://images.pexels.com/photos/1687845/pexels-photo-1687845.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'serengeti']),
            ],
            [
                'label' => 'Coastal',
                'title' => 'Amalfi Coast',
                'destination' => 'Italy',
                'flag' => '🇮🇹',
                'image' => 'https://images.pexels.com/photos/1619635/pexels-photo-1619635.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'amalfi-coast']),
            ],
            [
                'label' => 'Ancient',
                'title' => 'Egypt',
                'destination' => 'Egypt',
                'flag' => '🇪🇬',
                'image' => 'https://images.pexels.com/photos/2487719/pexels-photo-2487719.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'egypt']),
            ],
            [
                'label' => 'Urban',
                'title' => 'Tokyo',
                'destination' => 'Japan',
                'flag' => '🇯🇵',
                'image' => 'https://images.pexels.com/photos/2506923/pexels-photo-2506923.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'tokyo']),
            ],
            [
                'label' => 'Wine',
                'title' => 'Tuscany',
                'destination' => 'Italy',
                'flag' => '🇮🇹',
                'image' => 'https://images.pexels.com/photos/2589645/pexels-photo-2589645.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'tuscany']),
            ],
            [
                'label' => 'Pristine',
                'title' => 'New Zealand',
                'destination' => 'New Zealand',
                'flag' => '🇳🇿',
                'image' => 'https://images.pexels.com/photos/1404825/pexels-photo-1404825.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'new-zealand']),
            ],
            
            // Cards 21-30 (Page 3)
            [
                'label' => 'Scenic',
                'title' => 'Norway',
                'destination' => 'Norway',
                'flag' => '🇳🇴',
                'image' => 'https://images.pexels.com/photos/1933438/pexels-photo-1933438.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'norway']),
            ],
            [
                'label' => 'Cultural',
                'title' => 'Morocco',
                'destination' => 'Morocco',
                'flag' => '🇲🇦',
                'image' => 'https://images.pexels.com/photos-1539023/pexels-photo-1539023.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'morocco']),
            ],
            [
                'label' => 'Island',
                'title' => 'Seychelles',
                'destination' => 'Seychelles',
                'flag' => '🇸🇨',
                'image' => 'https://images.pexels.com/photos-2187607/pexels-photo-2187607.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'seychelles']),
            ],
            [
                'label' => 'Historic',
                'title' => 'Prague',
                'destination' => 'Czech Republic',
                'flag' => '🇨🇿',
                'image' => 'https://images.pexels.com/photos/2187609/pexels-photo-2187609.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'prague']),
            ],
            [
                'label' => 'Arctic',
                'title' => 'Lapland',
                'destination' => 'Finland',
                'flag' => '🇫🇮',
                'image' => 'https://images.pexels.com/photos/2187611/pexels-photo-2187611.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'lapland']),
            ],
            [
                'label' => 'Tropical',
                'title' => 'Fiji',
                'destination' => 'Fiji',
                'flag' => '🇫🇯',
                'image' => 'https://images.pexels.com/photos2187613/pexels-photo-2187613.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'fiji']),
            ],
            [
                'label' => 'Desert',
                'title' => 'Wadi Rum',
                'destination' => 'Jordan',
                'flag' => '🇯🇴',
                'image' => 'https://images.pexels.com/photos/2187615/pexels-photo-2187615.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'wadi-rum']),
            ],
            [
                'label' => 'Mountain',
                'title' => 'Patagonia',
                'destination' => 'Argentina',
                'flag' => '🇦🇷',
                'image' => 'https://images.pexels.com/photos/2187617/pexels-photo-2187617.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'patagonia']),
            ],
            [
                'label' => 'Imperial',
                'title' => 'Vienna',
                'destination' => 'Austria',
                'flag' => '🇦🇹',
                'image' => 'https://images.pexels.com/photos/2187619/pexels-photo-2187619.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'vienna']),
            ],
            [
                'label' => 'Regal',
                'title' => 'London',
                'destination' => 'United Kingdom',
                'flag' => '🇬🇧',
                'image' => 'https://images.pexels.com/photos/2187621/pexels-photo-2187621.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'london']),
            ],
            
            // Cards 31-40 (Page 4)
            [
                'label' => 'Tropical',
                'title' => 'Hawaii',
                'destination' => 'United States',
                'flag' => '🇺🇸',
                'image' => 'https://images.pexels.com/photos/2187623/pexels-photo-2187623.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'hawaii']),
            ],
            [
                'label' => 'Maritime',
                'title' => 'Croatia',
                'destination' => 'Croatia',
                'flag' => '🇭🇷',
                'image' => 'https://images.pexels.com/photos/2187625/pexels-photo-2187625.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'croatia']),
            ],
            [
                'label' => 'Colonial',
                'title' => 'Lisbon',
                'destination' => 'Portugal',
                'flag' => '🇵🇹',
                'image' => 'https://images.pexels.com/photos/2187627/pexels-photo-2187627.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'lisbon']),
            ],
            [
                'label' => 'Alpine',
                'title' => 'Chamonix',
                'destination' => 'France',
                'flag' => '🇫🇷',
                'image' => 'https://images.pexels.com/photos/2187629/pexels-photo-2187629.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'chamonix']),
            ],
            [
                'label' => 'Volcanic',
                'title' => 'Hawaii Volcanoes',
                'destination' => 'United States',
                'flag' => '🇺🇸',
                'image' => 'https://images.pexels.com/photos/2187631/pexels-photo-2187631.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'hawaii-volcanoes']),
            ],
            [
                'label' => 'Sacred',
                'title' => 'Varanasi',
                'destination' => 'India',
                'flag' => '🇮🇳',
                'image' => 'https://images.pexels.com/photos/2187633/pexels-photo-2187633.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'varanasi']),
            ],
            [
                'label' => 'Metropolitan',
                'title' => 'Singapore',
                'destination' => 'Singapore',
                'flag' => '🇸🇬',
                'image' => 'https://images.pexels.com/photos/2187635/pexels-photo-2187635.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'singapore']),
            ],
            [
                'label' => 'Bay',
                'title' => 'Hong Kong',
                'destination' => 'China',
                'flag' => '🇭🇰',
                'image' => 'https://images.pexels.com/photos/2187637/pexels-photo-2187637.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'hong-kong']),
            ],
            [
                'label' => 'Emerald',
                'title' => 'Ireland',
                'destination' => 'Ireland',
                'flag' => '🇮🇪',
                'image' => 'https://images.pexels.com/photos/2187639/pexels-photo-2187639.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'ireland']),
            ],
            [
                'label' => 'Glacial',
                'title' => 'Alaska',
                'destination' => 'United States',
                'flag' => '🇺🇸',
                'image' => 'https://images.pexels.com/photos/2187641/pexels-photo-2187641.jpeg?auto=compress&cs=tinysrgb&w=800',
                'url' => route('destinations.show', ['slug' => 'alaska']),
            ],
        ];
        
        return $destinations;
    }
    
    /**
     * Generate pagination range with ellipsis for large page counts.
     * 
     * @param int $currentPage
     * @param int $totalPages
     * @return array
     */
    private function generatePaginationRange($currentPage, $totalPages)
    {
        $range = [];
        $showPages = 5; // Pages to show before/after current
        
        if ($totalPages <= 7) {
            // Show all pages
            for ($i = 1; $i <= $totalPages; $i++) {
                $range[] = $i;
            }
        } else {
            // Always show first page
            $range[] = 1;
            
            if ($currentPage > $showPages) {
                $range[] = '...';
            }
            
            // Calculate range around current page
            $start = max(2, $currentPage - floor($showPages / 2));
            $end = min($totalPages - 1, $currentPage + floor($showPages / 2));
            
            // Adjust if at the beginning
            if ($currentPage <= $showPages) {
                $end = $showPages;
            }
            
            // Adjust if at the end
            if ($currentPage > $totalPages - $showPages) {
                $start = $totalPages - $showPages + 1;
            }
            
            for ($i = $start; $i <= $end; $i++) {
                $range[] = $i;
            }
            
            if ($currentPage < $totalPages - $showPages + 1) {
                $range[] = '...';
            }
            
            // Always show last page
            $range[] = $totalPages;
        }
        
        return $range;
    }
    
    /**
     * Show a single destination (placeholder).
     * 
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        return view('destination-show', ['slug' => $slug]);
    }
}
