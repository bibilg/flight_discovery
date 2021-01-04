<?php
require_once 'vendor/autoload.php';

class ApiTest extends IntegrationTestCase{

    public function test_api_helloworld()
    {
        $response = $this->make_request("GET", "/api/helloworld");
        $this->assertEquals(200, $response->getStatusCode());
      //  $this->assertContains("application/json", $response->getHeader('Content-Type')[0]);


        $body = $response->getBody()->getContents();

        $json_result = json_encode(['data' => 'Hello World!']);

        $this->assertEquals($json_result, $body);
    }
}