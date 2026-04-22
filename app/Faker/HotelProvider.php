<?php

namespace App\Faker;


use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelProvider extends Base
{

    /* public function definition(): array
    {
        $this->faker->addProvider(new HotelProvider($this->faker));
        return [
            'hotel_name' => fake()->coolHotel(),
            'location' => fake()->coolLocation(),
            'picture' => fake()->coolPicture(),

        ];
    } */

    protected static $hotelNames = [
        'Azure Horizon Retreat',
        'Coral Whisper Manor',
        'Serenity Tide Lodge',
        'Palm Mirage Resort',
        'Golden Dune Sanctuary',
        'Velvet Wave Villa',
        'Sunset Cay Estate',
        'Sunset Cay Estate',
        'Azure Anchor Inn',
        "Beachcomber's Dream",
        'Maritime Magic Resort',
        'Shoreline Splendor',
        'Ocean Mist Manor',
        'Tidal Grace Hotel',
        "Seagull's Rest",
        'Wave Dancer Inn',
        'Salty Air Sanctuary',
        'Coral Cove Retreat',
        'Beachside Bliss',
        'Oceanfront Opulence',
        'Seashell Suites',
        'Harbor Light Lodge',
        'Tidepool Terrace',
        'Coastal Crown',
        'Reef & Relaxation',
        'Maritime Manor',
        'Lagoon View Retreat',
        'Pelican Point Estate',
        'Driftwood Palace',
        'Oceanic Oasis',
        'Seabreeze Manor',
        'Shoreline Sanctuary',
        'Tropic Twilight Inn',
        'Nautical Nights Resort',
        "Beachcomber's Haven",
        'Sapphire Shore Lodge',
        'Wave Crest Pavilion',
        'Coastal Dreams Manor',
        'Seaside Serenade',
        'Marina Pearl Inn',
        'Sunset Cay Estate',
        'Tide & Tranquility',
    ];

    protected static $hotelPic = [
        'media/hotelPictures/hotel1.png',
        'media/hotelPictures/hotel2.png',
        'media/hotelPictures/1776028809.png',
        'media/hotelPictures/1776028814.png',
        'media/hotelPictures/1776028819.png',
        'media/hotelPictures/1776028836.png',
        'media/hotelPictures/1776028842.png',
        'media/hotelPictures/1776028849.png',
        'media/hotelPictures/1776028855.png',
        'media/hotelPictures/1776028861.png',
        'media/hotelPictures/1776028866.png',
        'media/hotelPictures/1776028872.png',
        'media/hotelPictures/1776028877.png',
        'media/hotelPictures/1776028910.png',
        'media/hotelPictures/1776028916.png',
        'media/hotelPictures/1776028922.png',
        'media/hotelPictures/1776028926.png',
        'media/hotelPictures/1776028934.png',
        'media/hotelPictures/1776028947.png',
        'media/hotelPictures/1776028952.png',
        'media/hotelPictures/1776028965.png',
        'media/hotelPictures/1776028971.png',
        'media/hotelPictures/1776028977.png',
        'media/hotelPictures/1776165502.png',
        'media/hotelPictures/1776165512.png',
        'media/hotelPictures/1776165522.png',
        'media/hotelPictures/1776165539.png',
        'media/hotelPictures/1776165549.png',
        'media/hotelPictures/1776166081.png',
        'media/hotelPictures/1776166130.png',
        'media/hotelPictures/1776166166.png',
        'media/hotelPictures/1776166224.png',
        'media/hotelPictures/1776166236.png',
        'media/hotelPictures/1776228291.png',
        'media/hotelPictures/1776228296.png',
        'media/hotelPictures/1776228307.png',
        'media/hotelPictures/1776228324.png',
        'media/hotelPictures/1776228613.png',
        'media/hotelPictures/1776228629.png',
        'media/hotelPictures/1776228636.png',
    ];

    protected static $hotelLocation = [
        'Hawaii',
        'Jamaica',
        'Japan',
        'Mauritius',
        'Maldives',
        'Normandy',
        'Seychelles',
        'Singapore',
        'Spain',
        'Thailand',
    ];


    public function coolHotel(): string
    {
        return static::randomElement(static::$hotelNames);
    }
    public function coolLocation(): string
    {
        return static::randomElement(static::$hotelLocation);
    }
    public function coolPicture(): string
    {
        return static::randomElement(static::$hotelPic);
    }
}/* 
for($i=0; $i<6; $i++)
    echo '<br>' .rand(0,1);
    echo '<br>' .random_int(0,1); */
