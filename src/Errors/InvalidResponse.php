<?php
namespace Geolocation\Errors;

use Throwable;

class InvalidResponse extends \Error
{
    public function __construct( string $message = null, $code = 4, Throwable $previous = null )
    {
        $message = $message ?? 'An invalid response was returned from GCP Service';
        parent::__construct( $message, $code, $previous );
    }
}
