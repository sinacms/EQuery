<?php
include_once "bootstrap.php";
use equery\dsl;
use equery\dsl\term;
use equery\dsl\term\terms;
use equery\dsl\text;
use equery\dsl\compound;
use equery\dsl\match_all;


$rb = new equery\request\requestbody();
$dsl =new  equery\dsl\term\terms("docCategory_i", ['6', '15', '33', '10', '3', '13', '30', '23', '24', '21', '16', '27', '7', '29', '8']);
$aggs = [
    "doccat" => [
        "terms" => [
            "field" => "docCategory_i"
        ]
    ]
];

$rb->Query($dsl)->From(10)->Size(1)->Sort(["cTime"=>"desc"])->Aggs($aggs);
print_r($rb->ToJson());

$rq = new equery\request\request(["host"=>"10.83.0.44", "port"=>"9201", "path" => "/acomos*/_search?_source=false"]);
$opts = ["header" => array(), "timeout" => 5];
$a = $rq->doRequest($rb, $opts);
$realRetStr = $a['result'];
print_r(json_decode($realRetStr, 1));



