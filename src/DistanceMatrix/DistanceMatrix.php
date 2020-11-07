<?php
namespace Geolocation\DistanceMatrix;

use Geolocation\Contracts\GeolocationService;
use Geolocation\Exceptions;

/**
 * Simple, resource saver vanilla PHP Location Lib
 * Class DistanceMatrix
 * @package adrianoalves/google-geolocation
 */
class DistanceMatrix implements GeolocationService
{
    /**
     * @var resource|null
     */
    public $client = null;

    /**
     * default configurations
     * @var array
     */
    public $params = [
        'mode'     => Settings::MODE[ 'driving' ],
        'units'    => Settings::UNIT[ 'metric' ],
        'language' => Settings::LANGUAGE
    ];
    /**
     * Human readable origin addresses
     * @var array
     */
    protected $origins      = [];
    /**
     * Human readable destination addresses
     * @var array
     */
    protected $destinations = [];

    /**
     * DistanceMatrix constructor.
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
            throw new Exceptions\NoApiKeyException();
    }

    /**
     * Requests the geo coordinates from Human readable addresses.
     * It will be useful to determine the distance between the user to a store, restaurant, shopping, service center, constrain a promotion physical reach...
     * @param array|null $origins Origins array
     * @param array|null $destinations Destinations array
     * @return array|null
     * @throws Exceptions\AddressTypeException
     * @throws Exceptions\DestinationsNotFoundException
     * @throws Exceptions\OriginsNotFoundException
     */
    public function request( array $origins = null, array $destinations = null ): array
    {
        if( $origins )
            $this->addAddresses( $origins );

        if( $destinations )
            $this->addAddresses( $destinations, 'destinations' );

        $this->validate();

        $url = Settings::URL . \http_build_query( $this->params );
        $url .= '&origins=' . $this->convertAddresses( $this->origins );
        $url .= '&destinations=' . $this->convertAddresses( $this->destinations );

        \curl_setopt( $this->client, \CURLOPT_URL, $url );
        $response = \curl_exec( $this->client );

        return $this->getResponse( $response );
    }

    /**
     * Parses a json string response
     * @param string $response a json string response from gcp maps service
     * @return null|array returns an Array with distance and car travel duration time between origin and destination
     */
    public function getResponse( string $response ) : array
    {
        $result = null;
        $response = json_decode( $response );
        if( is_object( $response ) && $response->status === 'OK' ){
            $result = [];
            foreach( $response->rows as $row ){
                foreach ( $row->elements as $element ){
                    if( $element->status === 'OK' ){
                        $result[] = [ 'distance' => $element->distance->value, 'duration' => $element->duration->value ];
                    }
                }
            }
        }

        return $result;
    }

    /**
     * simple validation
     * @todo implement a entity to specialize the validation methods
     * @throws Exceptions\DestinationsNotFoundException
     * @throws Exceptions\OriginsNotFoundException
     */
    protected function validate()
    {
        if( !$this->origins )
            throw new Exceptions\OriginsNotFoundException;

        if( !$this->destinations )
            throw new Exceptions\DestinationsNotFoundException;

    }

    /**
     * @param array $addresses the addresses formatted according to the distance matrix documentation
     * @param string $type 'origins' or 'destinations', defaults to 'origins'
     * @return DistanceMatrix the object itself
     * @throws Exceptions\AddressTypeException
     * @see https://developers.google.com/maps/documentation/distance-matrix/intro#DistanceMatrixRequests
     */
    public function addAddresses( array $addresses, $type = 'origins' ) : DistanceMatrix
    {
        if( !in_array( $type, ['destinations', 'origins' ] ) )
            throw new Exceptions\AddressTypeException( "The $type is not a valid address type" );

        foreach( $addresses as $address ){
            if( !in_array( $address, $this->$type ) )
                $this->$type[] = $address;
        }
        return $this;
    }

    /**
     * helper method to deal with an array of addresses
     * @param array $addresses addresses that wil be split by pipe "|"
     * @return string
     */
    public function convertAddresses( array $addresses ): string
    {
        return urlencode( implode('|', $addresses ) );
    }
}
