<?php
include_once "bootstrap.php";
use EQuery\dsl;
use EQuery\dsl\term;
use EQuery\dsl\text;
use EQuery\dsl\compound;

function docSearch($expr, $size, $page, $sort, $fieldlist ) {
    $requestbody = new EQuery\request\requestbody();
    $from = ($page - 1) * $size;
    $requestbody->Query($expr)->FromSize($from, $size)->Sort($sort)->Source($fieldlist);
    $request = new EQuery\request\request("localhost", "9200");
    $request->doSearch($requestbody);
}
docSearch(_notnull("tags"), 10, 1, array("cTime" => "desc"), "false");


function _and(){
    $exprArr    = func_get_args();
    $dslo       = new EQuery\dsl\compound\compoundbool();
    foreach ($exprArr as $expr) {
        if (empty($expr)) continue;
        $dslo->must($expr);
    }
    return $dslo;
}

function _or(){
    $exprArr    = func_get_args();
    $dslo       = new EQuery\dsl\compound\compoundbool();
    foreach ($exprArr as $expr) {
        if (empty($expr)) continue;
        $dslo->should($expr);
    }
    $dslo->minimum_should_match(1);
    return $dslo;
}

function _not($expr){
    $dslo = new EQuery\dsl\compound\compoundbool();
    return $dslo->must_not($expr);
}

function _eq($fieldname, $value){
    $dslo = new EQuery\dsl\text\term($fieldname, $value);
    return $dslo;
}

function _gt($fieldname, $value){
    $dslo = new EQuery\dsl\text\termrange();
    $dslo->gt($fieldname, $value)
    return $dslo;
}

function _lt($fieldname, $value){
    $dslo = new EQuery\dsl\text\termrange();
    $dslo->lt($fieldname, $value)
    return $dslo;
}

function _gteq($fieldname, $value){
    $dslo = new EQuery\dsl\text\termrange();
    $dslo->gte($fieldname, $value)
    return $dslo;
}

function _lteq($fieldname, $value){
    $dslo = new EQuery\dsl\text\termrange();
    $dslo->lte($fieldname, $value)
    return $dslo;
}

function _match($fieldname, $value){
    $dslo = new EQuery\dsl\text\match($fieldname, $value);
    return $dslo;
}

function _in($fieldname, $values){
    $dslo = new EQuery\dsl\term\terms($fieldname, $values);
    return $dslo;
}

function _notnull($fieldname){
    $dslo = new EQuery\dsl\term\exists($fieldname);
    return $dslo;
}

function _kv($k, $v) {
    return new EQuery\dsl\kv($k, $v);
}
