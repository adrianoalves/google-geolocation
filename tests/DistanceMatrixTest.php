<?php

class DistanceMatrixTest extends \PHPUnit\Framework\TestCase
{
    public function testHasApiKey(): void
    {
        $distanceMatrix = new Geolocation\DistanceMatrix\DistanceMatrix( 'abcde12345');
        $this->assertArrayHasKey('key', $distanceMatrix->params );
    }

    public function testNoApiKeyException(): void
    {
        $this->expectException( Geolocation\Exceptions\NoApiKeyException::class );
        new Geolocation\DistanceMatrix\DistanceMatrix();
    }

    public function testDependencyCurlExtensionIsInstalled(): void
    {
        $this->assertTrue( extension_loaded( 'curl' ) );
        $this->assertTrue( \function_exists( 'curl_init' ) );
        $this->assertTrue( \function_exists( 'curl_exec' ) );
    }

    public function testClientIsResource(): void
    {
        $this->assertIsResource( ( new \Geolocation\DistanceMatrix\DistanceMatrix('my-apikey-from-google' ) )->client );
    }
}
