<?php
namespace Geolocation\Exceptions;

class OriginsNotFoundException extends \Exception
{
    public function __construct( string $message = null )
    {
        $message = $message ?? 'Please add at least one origin';
        parent::__construct( $message, 22, null );
    }
}
