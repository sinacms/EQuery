<?php
namespace equery\dsl\term;

class termrange extends \equery\dsl\dsla  {
    public function __construct() {
        $this->obj['range'] = array();
    }
    public function gt($field, $value) {
        $this->obj['range'][$field]["gt"] =  $value;
        return $this;
    }
    public function lt($field, $value) {
        $this->obj['range'][$field]["lt"] =  $value;
        return $this;
    }
    public function gte($field, $value) {
        $this->obj['range'][$field]["gte"] =  $value;
        return $this;
    }
    public function lte($field, $value) {
        $this->obj['range'][$field]["lte"] =  $value;
        return $this;
    }
}
