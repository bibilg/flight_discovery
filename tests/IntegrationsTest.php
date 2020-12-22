<?php
require_once 'vendor/autoload.php';

class PagesIntegrationTest extends IntegrationTestCase{

    public function test_index()
    {
        $response = $this->make_request("GET", "/");
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("Hello world!", $response->getBody()->getContents());
    }

    public function test_hello()
    {
        $response = $this->make_request("GET", "/hello/test");
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("Hello, test!", $response->getBody()->getContents());

    }
}