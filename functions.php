<?php
use EQuery\dsl;
use EQuery\dsl\term;
use EQuery\dsl\text;
use EQuery\dsl\compound;

// new request and requestbody
function newEQueryBody() {
    return new \EQuery\request\requestbody();
}



// simple dsl expr functions
function _bool() {
    return new EQuery\dsl\compound\compoundbool();
}

function _kv($k, $v) {
    return new EQuery\dsl\kv($k, $v);
}
// old functions

// compound dsl
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

// leaf dsl
function _eq($fieldname, $value){
    $dslo = new EQuery\dsl\term\term($fieldname, $value);
    return $dslo;
}

function _gt($fieldname, $value){
    $dslo = new EQuery\dsl\term\termrange();
    $dslo->gt($fieldname, $value);
    return $dslo;
}

function _lt($fieldname, $value){
    $dslo = new EQuery\dsl\term\termrange();
    $dslo->lt($fieldname, $value);
    return $dslo;
}

function _gteq($fieldname, $value){
    $dslo = new EQuery\dsl\term\termrange();
    $dslo->gte($fieldname, $value);
    return $dslo;
}

function _lteq($fieldname, $value){
    $dslo = new EQuery\dsl\term\termrange();
    $dslo->lte($fieldname, $value);
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

