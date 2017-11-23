<?php

include_once __DIR__. DIRECTORY_SEPARATOR. "..". DIRECTORY_SEPARATOR. "bootstrap.php";
use PHPUnit\Framework\TestCase;
use EQuery\dsl;
use EQuery\dsl\text;

class TestRequest extends TestCase {
    public function testPushAndPop() {
        $stack = [];
        $this->assertEquals(0, count($stack));
    }
}
