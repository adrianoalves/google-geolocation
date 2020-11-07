<?php
namespace Geolocation\GeoCoder;

class Settings
{
    /**
     * google geocode uri endpoint
     */
    const URL = 'https://maps.googleapis.com/maps/api/geocode/json?';
    /**
     * points in the way to not consider on route calculation
     */
    const AVOID = [
        'tolls' => 'tolls',
        'highways' => 'highways',
        'ferries' => 'ferries',
        'indoor' => 'indoor',
    ];
    /**
     * ride modes to get a way
     */
    const MODE = [
        'bicycling' => 'bicycling',
        'driving' => 'driving',
        'transit' => 'transit',
        'walking' => 'walking',
    ];

    /**
     * distance unit to use in the route calculation
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
