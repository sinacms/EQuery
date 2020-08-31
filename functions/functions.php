<?php
/*
 * 暂时先不启用
use \equery\dsl;
use \equery\dsl\term;
use \equery\dsl\text;
use \equery\dsl\compound;



// simple dsl expr functions
function _bool() {
    return new \equery\dsl\compound\compoundbool();
}

function _kv($k, $v) {
    return new \equery\dsl\kv($k, $v);
}
// old functions

// compound dsl
function _and(){
    $exprArr    = func_get_args();
    $dslo       = new \equery\dsl\compound\compoundbool();
    foreach ($exprArr as $expr) {
        if (empty($expr)) continue;
        $dslo->must($expr);
    }
    return $dslo;
}

function _or(){
    $exprArr    = func_get_args();
    $dslo       = new \equery\dsl\compound\compoundbool();
    foreach ($exprArr as $expr) {
        if (empty($expr)) continue;
        $dslo->should($expr);
    }
    $dslo->minimum_should_match(1);
    return $dslo;
}

function _not($expr){
    $dslo = new \equery\dsl\compound\compoundbool();
    return $dslo->must_not($expr);
}

// leaf dsl
function _eq($fieldname, $value){
    $dslo = new \equery\dsl\term\term($fieldname, $value);
    return $dslo;
}

function _gt($fieldname, $value){
    $dslo = new \equery\dsl\term\termrange();
    $dslo->gt($fieldname, $value);
    return $dslo;
}

function _lt($fieldname, $value){
    $dslo = new \equery\dsl\term\termrange();
    $dslo->lt($fieldname, $value);
    return $dslo;
}

function _gteq($fieldname, $value){
    $dslo = new \equery\dsl\term\termrange();
    $dslo->gte($fieldname, $value);
    return $dslo;
}

function _lteq($fieldname, $value){
    $dslo = new \equery\dsl\term\termrange();
    $dslo->lte($fieldname, $value);
    return $dslo;
}

function _match($fieldname, $value, $options  = ["operator" => "and"]){
    $dslo = new \equery\dsl\text\match($fieldname, $value, $options);
    return $dslo;
}

function _in($fieldname, $values){
    $dslo = new \equery\dsl\term\terms($fieldname, $values);
    return $dslo;
}

function _notnull($fieldname){
    $dslo = new \equery\dsl\term\exists($fieldname);
    return $dslo;
}

 */
