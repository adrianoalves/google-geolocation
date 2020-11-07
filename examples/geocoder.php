<?php
require 'vendor/autoload.php';

try {
    $geoCoder = new \Geolocation\GeoCoder\GeoCoder('yoUr-aPiKey-hEre' );
    $result = $geoCoder->request( 'Praça da Sé, São Paulo, SP' );
    var_dump( $result );
}
// handle here the error exception properly // trate suas exceções de acordo com o tipo de exceção lançada
catch ( \Geolocation\Errors\InvalidResponse $errorException ){
    print $errorException->getMessage();
}
catch( \Geolocation\Exceptions\NoApiKeyException $exception ){
    print $exception->getMessage();
}
catch( Throwable $e ){
    print $e->getMessage();
}
