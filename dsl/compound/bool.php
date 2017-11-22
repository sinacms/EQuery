<?php


namespace EQuery\dsl\compound;
use EQuery\dsl;
use EQuery;

class compoundbool extends dsla  {
    public function __construct() {
        $this->obj["bool"] = array();
    }

    public function filter($obj) {
        if (!($obj instanceof EQuery\dsl\dsla)) {
            throw new EQueryException("compoundbool accept only dsl, but received ". print_r($obj));
        }
        $this->obj["bool"]['filter'][] = $obj;
    }
    public function must($obj) {
        if (!($obj instanceof EQuery\dsl\dsla)) {
            throw new EQueryException("compoundbool accept only dsl, but received ". print_r($obj));
        }
        $this->obj["bool"]['must'][] = $obj;
    }

    public function mustnot($obj) {
        if (!($obj instanceof EQuery\dsl\dsla)) {
            throw new EQueryException("compoundbool accept only dsl, but received ". print_r($obj));
        }
        $this->obj["bool"]['must_not'][] = $obj;
    }

    public function should($obj) {
        if (!($obj instanceof EQuery\dsl\dsla)) {
            throw new EQueryException("compoundbool accept only dsl, but received ". print_r($obj));
        }
        $this->obj["bool"]['should'][] = $obj;
    }

    public function minimum_should_match($num) {
        if (!is_numeric($num)) {
            throw new EQueryException("compoundbool minimum_should_match accept numerics, but received ". print_r($num));
        }
        $this->obj["bool"]['minimum_should_match'] = $num;
    }




}
