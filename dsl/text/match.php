<?php
namespace equery\dsl\text;
use equery\dsl;

class match extends \equery\dsl\dsla  {
    public function __construct($k, $v) {
        $this->obj['match'] = array($k => $v);
    }
}
