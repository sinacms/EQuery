<?php
use \equery\dsl;
use \equery\dsl\term;
use \equery\dsl\term\wildcard;
use \equery\dsl\text;
use \equery\dsl\compound;
use \equery\dsl\match_all;

// new request and requestbody
function newequeryRequestBody() {
    return new \equery\request\requestbody();
}



// simple dsl expr functions
function es_bool() {
    return new \equery\dsl\compound\compoundbool();
}
function es_kv($k, $v) {
    return new \equery\dsl\kv($k, $v);
}
function es_wildcard($k, $v) {
    return new \equery\dsl\term\wildcard($k, $v);
}
function es_match_all() {
    return new \equery\dsl\match_all();
}
// old functions

// compound dsl
function es_and(){
    $exprArr    = func_get_args();
    $dslo       = new \equery\dsl\compound\compoundbool();
    foreach ($exprArr as $expr) {
        if (empty($expr)) continue;
        $dslo->must($expr);
    }
    return $dslo;
}

function es_or(){
    $exprArr    = func_get_args();
    $dslo       = new \equery\dsl\compound\compoundbool();
    foreach ($exprArr as $expr) {
        if (empty($expr)) continue;
        $dslo->should($expr);
    }
    $dslo->minimum_should_match(1);
    return $dslo;
}

function es_not($expr){
    $dslo = new \equery\dsl\compound\compoundbool();
    return $dslo->must_not($expr);
}

// leaf dsl
function es_eq($fieldname, $value){
    $dslo = new \equery\dsl\term\term($fieldname, $value);
    return $dslo;
}

function es_gt($fieldname, $value){
    $dslo = new \equery\dsl\term\termrange();
    $dslo->gt($fieldname, $value);
    return $dslo;
}

function es_lt($fieldname, $value){
    $dslo = new \equery\dsl\term\termrange();
    $dslo->lt($fieldname, $value);
    return $dslo;
}

function es_gteq($fieldname, $value){
    $dslo = new \equery\dsl\term\termrange();
    $dslo->gte($fieldname, $value);
    return $dslo;
}

function es_lteq($fieldname, $value){
    $dslo = new \equery\dsl\term\termrange();
    $dslo->lte($fieldname, $value);
    return $dslo;
}

function es_match($fieldname, $value){
    $dslo = new \equery\dsl\text\match($fieldname, $value);
    return $dslo;
}

function es_in($fieldname, $values){
    $dslo = new \equery\dsl\term\terms($fieldname, $values);
    return $dslo;
}

function es_notnull($fieldname){
    $dslo = new \equery\dsl\term\exists($fieldname);
    return $dslo;
}

function es_exists($fieldname){
    $dslo = new \equery\dsl\term\exists($fieldname);
    return $dslo;
}

