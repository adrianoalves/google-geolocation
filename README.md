# google-geolocation
##### Resource saving, lightweight, framework-agnostic google geo location services in vanilla PHP

### What we can do

1. **Get Latitude and Longitude Coordinates of a Human readable Address with GeoCoder;**

2. **Calculates the distance and time between 2 physical points from its Human readable addresses considering the way and riding mode.** 

### Get it started

#### How to install

You can clone this repository or use composer to install this package:
```shell script
composer require adrianoalves/google-geolocation
```

Prior to use this package, you need an api key, register as a google developer, create a project with a billing account and generate your api key. 
To learn more [visit the official google documentation.](https://developers.google.com/maps/documentation/javascript/get-api-key)

- Using the Geocoder
```php
// a simplest example
$geoCoder = new \Geolocation\GeoCoder\GeoCoder( 'yoUr-aPiKey-hEre' );
// getting the latitude and longitude of an address
$result = $geoCoder->request( 'Praça da Sé, São Paulo, SP' );
var_dump( $result );
```

- Using the Distance Matrix
```php
// same simplest example here
$distanceMatrix = new \Geolocation\DistanceMatrix\DistanceMatrix( 'yoUr-aPiKey-hEre' );
// getting the distance in metrics and the time in seconds from an address to another
$result = $distanceMatrix->request( ['Praça da Sé, São Paulo, SP'], ['Avenida Paulista, 1, São Paulo, SP'] );
var_dump( $result );
```
There is a examples directory where you can learn more about how to use it easily.

_I appreciate any suggestions, critics, comments and bug report, so please let me know._
