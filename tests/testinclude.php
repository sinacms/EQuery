<?php
include_once __DIR__. DIRECTORY_SEPARATOR. "..". DIRECTORY_SEPARATOR. "..". DIRECTORY_SEPARATOR. "bootstrap.php";
use PHPUnit\Framework\TestCase;
use EQuery\dsl;
use EQuery\dsl\text;

class TestInclude extends TestCase {
    public function testPushAndPop() {
        $stack = [];
        $this->assertEquals(0, count($stack));

        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack)-1]);
        $this->assertEquals(1, count($stack));

        $this->assertEquals('foo', array_pop($stack));
        $this->assertEquals(0, count($stack));
    }

    public function testInc() {
        $kv = new EQuery\dsl\kv("key", "value");
        $this->assertEquals(1, 1);
    }

    public function testKv() {
        $kv = new EQuery\dsl\kv("key", "value");
        $this->assertEquals($kv->ToJson(), '{"key":"value"}');
        $this->assertEquals($kv->ToArray(), ["key"=> "value"]);
        $this->assertEquals($kv->Obj(), ["key"=> "value"]);
    }

    public function testMatch() {
        $kv = new EQuery\dsl\text\match("key", ['vk1' => 'vv1', 'vk2' => 'vv2']);
        $this->assertEquals($kv->ToJson(), '{"match":{"key":{"vk1":"vv1","vk2":"vv2"}}}');
        $this->assertEquals($kv->ToArray(), ["match"=>["key" => ["vk1"=> "vv1", "vk2"=> "vv2"]]]);
        $this->assertEquals($kv->Obj(), ["match"=>["key" => ["vk1"=> "vv1", "vk2"=> "vv2"]]]);
    }

    public function testMatch2() {
        $kvsimple = new EQuery\dsl\kv("vk1", "vv1");
        $kv = new EQuery\dsl\text\match("key", $kvsimple);
        $this->assertEquals($kv->ToArray(), ["match"=>["key"=>["vk1"=> "vv1"]]]);
        $this->assertEquals($kv->ToJson(), '{"match":{"key":{"vk1":"vv1"}}}');
    }

    public function testMatchPhrase() {
        $kvsimple = new EQuery\dsl\kv("vk1", "vv1");
        $kv = new EQuery\dsl\text\matchphrase("key", $kvsimple);
        $this->assertEquals($kv->ToArray(), ["match_phrase"=>["key"=>["vk1"=> "vv1"]]]);
        $this->assertEquals($kv->ToJson(), '{"match_phrase":{"key":{"vk1":"vv1"}}}');
    }

    public function testExist() {
    }


}










