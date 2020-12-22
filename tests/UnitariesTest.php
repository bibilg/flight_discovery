<?php

require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class UnitariesTest extends TestCase {

    public function test_multiply(){
        $this->assertEquals(4, multiply(2, 2));
        $this->assertEquals(21, multiply(7, 3));
    }
}