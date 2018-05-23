<?php

include_once __DIR__. DIRECTORY_SEPARATOR. "..". DIRECTORY_SEPARATOR. "bootstrap.php";
use PHPUnit\Framework\TestCase;
use equery\dsl;
use equery\dsl\text;
use equery\equeryException;


class TestRequest extends TestCase {
    public static function setUpBeforeClass()
    {
        // do init
        //exec("sh ". __DIR__. DIRECTORY_SEPARATOR. "init.sh");
    }

    public function testrequest0() {
        $rb = new equery\request\requestbody();
        $dsl = es_bool()->must_not(es_in("field3", [8, 29]));
        $rb->Query($dsl)->From(0)->Size(10)->Sort(["field4"=>"desc"])->SearchAfter([1410430210001]);//  2014-09-11 10:10:10 is 1410430210000
        $rq = new equery\request\request(["host"=>"localhost", "port"=>"9200", "path" => "/equery/_search"]);
        $opts = ["header" => array(), "timeout" => 5];
        $a = $rq->doRequest($rb, $opts);
        $result = json_decode($a["result"], 1);
        $expect = Array (
                    "took" => 7,
                    "timed_out" => false,
                    "_shards" => Array
                        (
                            "total" => 5,
                            "successful" => 5,
                            "skipped" => 0,
                            "failed" => 0
                        ),
                    "hits" => Array(
                            "total" => 1,
                            "max_score" => "",
                            "hits" => Array(
                                    Array
                                        (
                                            "_index" => "equery",
                                            "_type" => "equery",
                                            "_id" => 1,
                                            "_score" => "",
                                            "_source" => Array(
                                                    "field1" => "to be or not to be",
                                                    "field2" => "to be",
                                                    "field3" => "9",
                                                    "field4" => "2014-09-11 10:10:10"
                                                ),
                                            "sort" => Array(
                                                    1410430210000
                                                )
                                        )
                                )
                        )
                );
        $this->assertEquals($expect["hits"], $result["hits"]);
    }

    public function testrequest1() {
        $rb = new equery\request\requestbody();
        $dsl = es_and(es_and(es_gteq("field4", "2012-10-11 00:00:00"), es_lt("field4", "2017-11-11T00:00:00Z")), es_or(es_not(es_eq("field2", "testnot")), es_match("field1", "to be")), es_in("field3", [8,9, 10]));
        $rb->Query($dsl)->From(0)->Size(10);
        $rq = new equery\request\request(["host"=>"localhost", "port"=>"9200", "path" => "/equery/_search"]);
        $opts = ["header" => array(), "timeout" => 5];
        $a = $rq->doRequest($rb, $opts);
        $result = json_decode($a["result"], 1);
        $hits = [
            "total" => 3,
            "max_score" => 4.791126,
            "hits" =>[
                    ["_index"=>"equery","_type"=>"equery","_id"=>"1","_score"=>4.791126,"_source"=>[
                        "field1"=> "to be or not to be",
                        "field2"=> "to be",
                        "field3"=> 9,
                        "field4"=> "2014-09-11 10:10:10"
                    ]],["_index"=>"equery","_type"=>"equery","_id"=>"3","_score"=>4.575364,"_source"=>[
                        "field1"=> "or not to be",
                        "field2"=> "to be2",
                        "field3"=> 8,
                        "field4"=> "2014-09-13 10:10:10"
                    ]],["_index"=>"equery","_type"=>"equery","_id"=>"2","_score"=>4.0,"_source"=>[
                        "field2"=> "to be2",
                        "field3"=> 8,
                        "field4"=> "2014-09-12 10:10:10"
                    ]]]];
        $this->assertEquals($hits, $result["hits"]);
    }

    public function testrequestnotdsl() {
        try {
            // 这里写上会引发异常的代码
            $rb = new equery\request\requestbody();
            $dsl = " not dsl";
            $rb->Query($dsl)->From(0)->Size(10);
            $rq = new equery\request\request(["host"=>"localhost", "port"=>"9200", "path" => "/equery/_search"]);
            $opts = ["header" => array(), "timeout" => 5];
            $a = $rq->doRequest($rb, $opts);
        } catch (equeryException $ex) {
            $this->assertEquals($ex->getMessage(), 'equery add query accepts only dsl, but received:" not dsl"');
            return;
            // 抓到异常测试通过
        }
        // 没抓到异常就算失败
        $this->fail('An expected exception has not been raised.' );
    }
    public function testrequesterr() {
        try {
            // 这里写上会引发异常的代码
            $rb = new equery\request\requestbody();
            $dsl = es_eq("hihi", "hihi");
            $rb->Query($dsl)->From(0)->Size(10);
            $rq = new equery\request\request(["host"=>"abcd.com", "path" => "/equery/_search"]);
            $opts = ["header" => array(), "timeout" => 5];
            $a = $rq->doRequest($rb, $opts);
        } catch (equeryException $ex) {
            $this->assertEquals($ex->getMessage(), 'new equery\equest\equest err: empty host or port{"host":"abcd.com","path":"\/equery\/_search"}');
            return;
            // 抓到异常测试通过
        }
        // 没抓到异常就算失败
        $this->fail('An expected exception has not been raised.' );
    }
    public function testdslboolerr() {
        try {
            // 这里写上会引发异常的代码
            $rb = new equery\request\requestbody();
            $dsl = es_and("hihi", "hihi");
            $rb->Query($dsl)->From(0)->Size(10);
            $rq = new equery\request\request(["host"=>"abcd.com", "path" => "/equery/_search"]);
            $opts = ["header" => array(), "timeout" => 5];
            $a = $rq->doRequest($rb, $opts);
        } catch (equeryException $ex) {
            $this->assertEquals($ex->getMessage(), 'compoundbool must accept only dsl, but received "hihi"');
            return;
            // 抓到异常测试通过
        }
        // 没抓到异常就算失败
        $this->fail('An expected exception has not been raised.' );
    }
}
