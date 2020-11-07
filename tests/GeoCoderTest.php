<?php
use PHPUnit\Framework\TestCase;

class GeoCoderTest extends TestCase
{
    public function testHasApiKey(): void
    {
        $geoCoder = new Geolocation\GeoCoder\GeoCoder( 'abcde12345');
        $this->assertArrayHasKey('key', $geoCoder->params );
    }

    public function testNoApiKeyException(): void
    {
        $this->expectException( Geolocation\Exceptions\NoApiKeyException::class );
        new Geolocation\GeoCoder\GeoCoder();
    }

    public function testDependencyCurlExtensionIsInstalled(): void
    {
        $this->assertTrue( extension_loaded( 'curl' ) );
        $this->assertTrue( \function_exists( 'curl_init' ) );
        $this->assertTrue( \function_exists( 'curl_exec' ) );
    }

    public function testClientIsResource(): void
    {
        $this->assertIsResource( ( new \Geolocation\GeoCoder\GeoCoder('your-apikey-from-google' ) )->client );
    }
}
