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
//docSearch(_notnull("tags"), 10, 1, array("cTime" => "desc"), "_id, cTime, title,cIDs");
docSearch(_notnull("tags"), 10, 1, array("cTime" => "desc"), "false");


function _and($expr0,$expr1){
}

function _or($expr0,$expr1){
}

function _not($expr){
}

function _eq($fieldname, $value){
}

function _gt($fieldname, $value){
}

function _lt($fieldname, $value){
}

function _gteq($fieldname, $value){
}

function _lteq($fieldname, $value){
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




