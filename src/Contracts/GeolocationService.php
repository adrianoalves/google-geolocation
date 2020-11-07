<?php
namespace Geolocation\Contracts;

interface GeolocationService
{
    public function getResponse( string $response ): array;
}
