<?php


namespace equery\dsl\compound;
use equery\dsl;
use equery\equeryException;

class compoundbool extends \equery\dsl\dsla  {
    public function __construct() {
        $this->obj["bool"] = array();
    }

    public function filter($obj) {
        if (!($obj instanceof \equery\dsl\dsla)) {
            throw new equeryException("compoundbool accept only dsl, but received ". print_r($obj, 1));
        }
        $this->obj["bool"]['filter'][] = $obj;
        return $this;
    }
    public function must($obj) {
        if (!($obj instanceof \equery\dsl\dsla)) {
            throw new equeryException("compoundbool accept only dsl, but received ". print_r($obj, 1));
        }
        $this->obj["bool"]['must'][] = $obj;
        return $this;
    }

    public function must_not($obj) {
        if (!($obj instanceof \equery\dsl\dsla)) {
            throw new equeryException("compoundbool accept only dsl, but received ". print_r($obj));
        }
        $this->obj["bool"]['must_not'][] = $obj;
        return $this;
    }

    public function should($obj) {
        if (!($obj instanceof \equery\dsl\dsla)) {
            throw new equeryException("compoundbool accept only dsl, but received ". print_r($obj, 1));
        }
        $this->obj["bool"]['should'][] = $obj;
        return $this;
    }

    public function minimum_should_match($num) {
        if (!is_numeric($num)) {
            throw new equeryException("compoundbool minimum_should_match accept numerics, but received ". print_r($num));
        }
        $this->obj["bool"]['minimum_should_match'] = $num;
        return $this;
    }

    public function clear() {
        $this->obj["bool"] = array();
    }



}
