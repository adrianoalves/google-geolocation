<?php
namespace Geolocation\Exceptions;

class AddressTypeException extends \Exception
{
    /**
     * AddressTypeException constructor.
     * @todo make a proper message
     * @param string $message A custom exception message to override the default address type exception
     */
    public function __construct( string $message = null )
    {
        $message = $message ?? 'Address type is not acceptable';
        parent::__construct( $message, 3, null );
    }
}
