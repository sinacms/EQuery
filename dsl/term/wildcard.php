<?php
namespace equery\dsl\term;

class wildcard extends \equery\dsl\dsla  {
    public function __construct($k, $v) {
        $this->obj['wildcard'] = array($k => $v);
    }
}
