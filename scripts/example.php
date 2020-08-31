<?php
include_once "bootstrap.php";
use equery\dsl;
use equery\dsl\term;
use equery\dsl\text;
use equery\dsl\compound;
use equery\dsl\match_all;

// old fashion
function docSearch($expr, $size, $page, $sort, $fieldlist) {
    $requestbody = new equery\request\requestbody();
    $from = ($page - 1) * $size;
    $requestbody->Query($expr)->From($from)->Size($size)->Sort($sort)->Source($fieldlist);
    $request = new equery\request\request(["host"=>"localhost", "port"=>"9200", "path" => "/newcomos2017/_search"]);
    $opts = ["header" => array(), "timeout" => 5];
    return $request->doRequest($requestbody, $opts);
}
$a = docSearch(es_notnull("tags"), 10, 1, array("cTime" => "desc"), "_id,tags");
print_r($a);


$a = docSearch(es_and(
	es_in('allCIDs',[28, 29]),
	es_eq('toTianyi',1),
	es_lteq('editLevel_i',3),
	es_gteq('fpTime',"2017-01-01 10:10:10")
), 10, 1, array("fpTime"=>"desc"),  "URL");

print_r($a);


// normal use
$rb = new equery\request\requestbody();
$dsl = es_bool()->must_not(es_in("allCIDs", [28, 29]))->should(es_notnull("tags"), es_notnull("toTianyi"))->minimum_should_match(1);
$rb->Query($dsl)->From(10)->Size(1)->Sort(["cTime"=>"desc"])->Source("_id,tags");
$rq = new equery\request\request(["host"=>"localhost", "port"=>"9200", "path" => "/newcomos2017/_search"]);
$opts = ["header" => array(), "timeout" => 5];
$a = $rq->doRequest($rb, $opts);
print_r($a);

$rb = new equery\request\requestbody();
$dsl =new  equery\dsl\match_all();
print_r($dsl->ToJson());
$rb->Query($dsl)->From(10)->Size(1)->Sort(["cTime"=>"desc"])->Source("_id,tags");
$rq = new equery\request\request(["host"=>"10.83.0.44", "port"=>"9201", "path" => "/comos*/_search"]);
$opts = ["header" => array(), "timeout" => 5];
$a = $rq->doRequest($rb, $opts);
print_r($a);
