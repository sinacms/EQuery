<?php
include_once __DIR__. DIRECTORY_SEPARATOR. "..". DIRECTORY_SEPARATOR. "bootstrap.php";
use PHPUnit\Framework\TestCase;
use equery\dsl;
use equery\dsl\text;

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
        $kv = new equery\dsl\kv("key", "value");
        $this->assertEquals(1, 1);
    }

    public function testKv() {
        $kv = new equery\dsl\kv();
        $kv->kv("key", "value");
        $this->assertEquals($kv->ToJson(), '{"key":"value"}');
        $this->assertEquals($kv->ToArray(), ["key"=> "value"]);
        $this->assertEquals($kv->Obj(), ["key"=> "value"]);
    }

    public function testMatch() {
        $kv = new equery\dsl\text\match("key", "vk");
        $this->assertEquals($kv->ToJson(), '{"match":{"key":{"query":"vk","operator":"and"}}}');
        $this->assertEquals($kv->ToArray(), ["match"=>["key" => ["query"=> "vk", "operator"=> "and"]]]);
        $this->assertEquals($kv->Obj(), ["match"=>["key" => ["query"=> "vk", "operator"=> "and"]]]);
    }

    public function testMatchPhrase() {
        $kvsimple = new equery\dsl\kv();
        $kvsimple->kv("vk1", "vv1");
        $kv = new equery\dsl\text\matchphrase("key", $kvsimple);
        $this->assertEquals($kv->ToArray(), ["match_phrase"=>["key"=>["vk1"=> "vv1"]]]);
        $this->assertEquals($kv->ToJson(), '{"match_phrase":{"key":{"vk1":"vv1"}}}');
    }

    public function testExists() {
        $kv = new equery\dsl\term\exists("key");
        $this->assertEquals($kv->ToArray(), ["exists"=>["field"=> "key"]]);
        $this->assertEquals($kv->ToJson(), '{"exists":{"field":"key"}}');
    }

    public function testRange() {
        $range = new equery\dsl\term\termrange;
        $range->gt ("field1", 17);
        $range->lte("field1", 40);
        $range->gte("field2", 40);
        $range->lt ("field3", "2017-12-12T10:11:11Z");
        $this->assertEquals($range->ToArray(), ["range"=>["field1"=> ["gt"=>17, "lte" => 40], "field2" => ["gte" => 40], "field3" => ["lt" => "2017-12-12T10:11:11Z"]]]);
        $this->assertEquals($range->ToJson(),  '{"range":{"field1":{"gt":17,"lte":40},"field2":{"gte":40},"field3":{"lt":"2017-12-12T10:11:11Z"}}}');
    }

    public function testTerms() {
        $terms = new equery\dsl\term\terms("field1", [17,20,1, "joke"]);
        $this->assertEquals($terms->ToArray(), ["terms"=>["field1"=> [17,20,1,"joke"]]]);
        $this->assertEquals($terms->ToJson(),  '{"terms":{"field1":[17,20,1,"joke"]}}');
    }

    public function testBoolMust() {
        $bool = new equery\dsl\compound\compoundbool();
        $terms = new equery\dsl\term\terms("field1", [17,20,1, "joke"]);
        $bool->must($terms);
        $this->assertEquals($bool->ToArray(), ["bool"=>["must"=>[["terms"=>["field1"=> [17,20,1,"joke"]]]]]]);
        $this->assertEquals($bool->ToJson(),  '{"bool":{"must":[{"terms":{"field1":[17,20,1,"joke"]}}]}}');
    }

    public function testBoolMustNot() {
        $bool = new equery\dsl\compound\compoundbool();
        $term = new equery\dsl\term\term("field1", "2017");
        $bool->must_not($term);
        $term = new equery\dsl\term\term("field2", "joke");
        $bool->must_not($term);
        $this->assertEquals($bool->ToArray(), ["bool"=>["must_not"=>[["term"=>["field1"=>2017]],["term"=>["field2"=>"joke"]]]]]);
        $this->assertEquals($bool->ToJson(),  '{"bool":{"must_not":[{"term":{"field1":"2017"}},{"term":{"field2":"joke"}}]}}');
    }

    public function testBoolShould() {
        $bool = new equery\dsl\compound\compoundbool();
        $term = new equery\dsl\term\term("field1", "2017");
        $bool->should($term);
        $term = new equery\dsl\term\term("field2", "joke");
        $bool->should($term);
        $this->assertEquals($bool->ToArray(), ["bool"=>["should"=>[["term"=>["field1"=>2017]],["term"=>["field2"=>"joke"]]]]]);
        $this->assertEquals($bool->ToJson(),  '{"bool":{"should":[{"term":{"field1":"2017"}},{"term":{"field2":"joke"}}]}}');
    }

    public function testBoolFilter() {
        $bool = new equery\dsl\compound\compoundbool();
        $term = new equery\dsl\term\term("field1", "2017");
        $bool->must($term);
        $bool2 = new equery\dsl\compound\compoundbool();
        $bool2->filter($bool);
        $this->assertEquals($bool2->ToArray(), ["bool"=>["filter"=>[["bool"=>["must"=>[["term"=>["field1"=>"2017"]]]]]]]]);
        $this->assertEquals($bool2->ToJson(),  '{"bool":{"filter":[{"bool":{"must":[{"term":{"field1":"2017"}}]}}]}}');
    }

}
