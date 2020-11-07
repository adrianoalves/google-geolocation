# google-geolocation
##### Resource saving, lightweight, framework-agnostic google geo location services in vanilla PHP

### What it Does

1. **Get Latitude and Longitude Coordinates of a Human readable Address with GeoCoder;**

2. **Calculates the distance and time between 2 physical points from its Human readable addresses considering the way and riding mode.** 

### Get it started

Prior to use this package, you need an api key, register as a google developer, create a project with a billing account and generate your api key. 
To learn more [visit the official google documentation.](https://developers.google.com/maps/documentation/javascript/get-api-key)

- Using the Geocoder
```php
// a simplest example
require 'vendor/autoload.php';
$geoCoder = new \Geolocation\GeoCoder\GeoCoder( 'yoUr-aPiKey-hEre' );
$result = $geoCoder->request( 'Praça da Sé, São Paulo, SP' );
var_dump( $result );
```

- Using the Distance Matrix
```php
// same simplest example here
require 'vendor/autoload.php';
$distanceMatrix = new \Geolocation\DistanceMatrix\DistanceMatrix( 'yoUr-aPiKey-hEre' );
$result = $distanceMatrix->request( ['Praça da Sé, São Paulo, SP'], ['Avenida Paulista, 1, São Paulo, SP'] );
var_dump( $result );
```
