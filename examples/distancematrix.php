<?php
require 'vendor/autoload.php';

try {

    $distanceMatrix = new \Geolocation\DistanceMatrix\DistanceMatrix('yoUr-aPiKey-hEre' );
    $result = $distanceMatrix->request( ['Praça da Sé, São Paulo, SP'], ['Avenida Paulista, 1, São Paulo, SP'] );
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
