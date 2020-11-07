<?php
namespace Geolocation\Exceptions;

class NoApiKeyException extends \Exception
{
    /**
     * NoApiKeyException constructor.
     * @param string|null $message custom exception message
     */
    public function __construct( string $message = null )
    {
        $message = $message ?? 'An API key is needed: please access your GCP account and create it.';
        parent::__construct( $message, 1, null );
    }
}
