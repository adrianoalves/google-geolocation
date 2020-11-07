<?php
namespace Geolocation\Exceptions;

class DestinationsNotFoundException extends \Exception
{
    public function __construct( string $message = null )
    {
        $message = $message ?? 'Please add at least one destination';
        parent::__construct( $message, 21, null );
    }
}
