<?php
include_once "bootstrap.php";
use EQuery\dsl;
use EQuery\dsl\term;
use EQuery\dsl\text;
use EQuery\dsl\compound;
use EQuery\dsl\match_all;

// old fashion
function docSearch($expr, $size, $page, $sort, $fieldlist) {
    $requestbody = new EQuery\request\requestbody();
    $from = ($page - 1) * $size;
    $requestbody->Query($expr)->From($from)->Size($size)->Sort($sort)->Source($fieldlist);
    $request = new EQuery\request\request(["host"=>"localhost", "port"=>"9200", "path" => "/newcomos2017/_search"]);
    $opts = ["header" => array(), "timeout" => 5];
    return $request->doRequest($requestbody, $opts);
}
$a = docSearch(_notnull("tags"), 10, 1, array("cTime" => "desc"), "_id,tags");
print_r($a);


$a = docSearch(_and(
	_in('allCIDs',[28, 29]),
	_eq('toTianyi',1),
	_lteq('editLevel_i',3),
	_gteq('fpTime',"2017-01-01 10:10:10")
), 10, 1, array("fpTime"=>"desc"),  "URL");

print_r($a);


// normal use
$rb = new EQuery\request\requestbody();
$dsl = _bool()->must_not(_in("allCIDs", [28, 29]))->should(_notnull("tags"), _notnull("toTianyi"))->minimum_should_match(1);
$rb->Query($dsl)->From(10)->Size(1)->Sort(["cTime"=>"desc"])->Source("_id,tags");
$rq = new EQuery\request\request(["host"=>"localhost", "port"=>"9200", "path" => "/newcomos2017/_search"]);
$opts = ["header" => array(), "timeout" => 5];
$a = $rq->doRequest($rb, $opts);
print_r($a);

$rb = new EQuery\request\requestbody();
$dsl =new  EQuery\dsl\match_all();
print_r($dsl->ToJson());
$rb->Query($dsl)->From(10)->Size(1)->Sort(["cTime"=>"desc"])->Source("_id,tags");
$rq = new EQuery\request\request(["host"=>"10.83.0.44", "port"=>"9201", "path" => "/comos*/_search"]);
$opts = ["header" => array(), "timeout" => 5];
$a = $rq->doRequest($rb, $opts);
print_r($a);
