<?php
include_once "bootstrap.php";
use EQuery\dsl;
use EQuery\dsl\term;
use EQuery\dsl\term\terms;
use EQuery\dsl\text;
use EQuery\dsl\compound;
use EQuery\dsl\match_all;


$rb = new EQuery\request\requestbody();
$dsl =new  EQuery\dsl\term\terms("docCategory_i", ['6', '15', '33', '10', '3', '13', '30', '23', '24', '21', '16', '27', '7', '29', '8']);
$aggs = [
    "doccat" => [
        "terms" => [
            "field" => "docCategory_i",
            "size"  => 100
        ]
    ]
];

$rb->Query($dsl)->From(10)->Size(1)->Sort(["cTime"=>"desc"])->Aggs($aggs);
print_r($rb->ToJson());

$rq = new EQuery\request\request(["host"=>"10.83.0.44", "port"=>"9201", "path" => "/acomos*/_search?_source=false"]);
$opts = ["header" => array(), "timeout" => 5];
$a = $rq->doRequest($rb, $opts);
$realRetStr = $a['result'];
print_r(json_decode($realRetStr, 1));



