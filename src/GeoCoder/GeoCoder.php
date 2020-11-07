<?php
namespace Geolocation\GeoCoder;

use Geolocation\Contracts\GeolocationService;
use Geolocation\Exceptions;
use Geolocation\Errors;

class GeoCoder implements GeolocationService
{
    /**
     * @var resource|null
     */
    public $client = null;

    /**
     * @var array
     */
    public $params = [
        'mode'     => null,
        'region'    => 'br',
        'language' => Settings::LANGUAGE,
        'address' => null
    ];

    /**
     * GeoCoder constructor.
     * @param string|null $apiKey
     * @throws Exceptions\NoApiKeyException
     */
    public function __construct( string $apiKey = null )
    {
        $this->client = \curl_init();
        \curl_setopt( $this->client, \CURLOPT_RETURNTRANSFER, 1 );
        \curl_setopt( $this->client, \CURLOPT_TIMEOUT, 10 );

        if( $apiKey )
            $this->params[ 'key' ] = $apiKey;
        else
            throw new Exceptions\NoApiKeyException;
    }

    /**
     * @param string $address an Human readable address to get Geo Coordinates
     * @return array
     * @throws Errors\InvalidResponse
     */
    public function request( string $address ): array
    {
        $this->params[ 'address' ] = $address;
        $url = Settings::URL.\http_build_query( $this->params );

        \curl_setopt( $this->client, \CURLOPT_URL, $url );
        $response = \curl_exec( $this->client );

        return $this->getResponse( $response );
    }

    /**
     * Parses the json string Response from the GCP Maps Service
     * @param string $response
     * @throws Errors\InvalidResponse
     * @return array|null Array with location object containing lat and lng parameters
     */
    public function getResponse( string $response ): array
    {
        $result = null;
        $response = json_decode( $response );

        if( is_object( $response ) && $response->status === 'OK' ){
            $result = [ 'location' => $response->results[0]->geometry->location, 'location_type' => $response->results[0]->geometry->location_type ];
        }
        else
            throw new Errors\InvalidResponse;

        return $result;
    }
    /**
     * Calculate the Distance in kilometers between two Geo Coordinate pairs
     * Useful to determine the geo-elegibility of an Offer, Promotion or Service to an User.
     * @param float $lat origin latitude
     * @param float $lon1 origin longitude
     * @param float $lat2 destination latitude
     * @param float $lon2 destination longitude
     * @return float|int
     */
    public function getDistance( float $lat, float $lon1, float $lat2, float $lon2 ): float
    {
        $radians = 0.017453292519943295; // result of pi() / 180
        $a = 0.5 - cos(($lat2 - $lat) * $radians)/2 + cos( $lat * $radians) * cos($lat2 * $radians ) * (1 - cos( ( $lon2 - $lon1 ) * $radians) )/2;
        $distance = 12742 * asin( sqrt( $a ) ); // 2 * R; R = 6371 km

        return (float) number_format( $distance, 3 );
    }
}
