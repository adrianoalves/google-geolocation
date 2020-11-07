<?php
namespace Geolocation\DistanceMatrix;

class Settings
{
    const URL = 'https://maps.googleapis.com/maps/api/distancematrix/json?';

    /**
     * what places avoid in the way
     */
    const AVOID = [
        'tolls' => 'tolls',
        'highways' => 'highways',
        'ferries' => 'ferries',
        'indoor' => 'indoor',
    ];

    /**
     * riding mode
     */
    const MODE = [
        'bicycling' => 'bicycling',
        'driving' => 'driving',
        'transit' => 'transit',
        'walking' => 'walking',
    ];

    /**
     * measure unit
     */
    const UNIT = [
        'imperial' => 'imperial',
        'metric' => 'metric'
    ];

    /**
     * default language
     */
    const LANGUAGE = 'pt-BR';

}
