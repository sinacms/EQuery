<?php

include_once __DIR__. DIRECTORY_SEPARATOR. "..". DIRECTORY_SEPARATOR. "bootstrap.php";
use PHPUnit\Framework\TestCase;
use EQuery\dsl;
use EQuery\dsl\text;


class TestRequest extends TestCase {
    public static function setUpBeforeClass()
    {
        // do init
        //exec("sh ". __DIR__. DIRECTORY_SEPARATOR. "init.sh");
    }

    public function testrequest0() {
        $rb = new EQuery\request\requestbody();
        $dsl = _bool()->must_not(_in("field3", [8, 29]));
        $rb->Query($dsl)->From(0)->Size(10)->Sort(["field4"=>"desc"])->SearchAfter([1410430210001]);//  2014-09-11 10:10:10 is 1410430210000
        $rq = new EQuery\request\request(["host"=>"localhost", "port"=>"9200", "path" => "/equery/_search"]);
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
        $rb = new EQuery\request\requestbody();
        $dsl = _and(_and(_gteq("field4", "2012-10-11 00:00:00"), _lt("field4", "2017-11-11T00:00:00Z")), _or(_not(_eq("field2", "testnot")), _match("field1", "to be")), _in("field3", [8,9, 10]));
        $rb->Query($dsl)->From(0)->Size(10);
        $rq = new EQuery\request\request(["host"=>"localhost", "port"=>"9200", "path" => "/equery/_search"]);
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
}
