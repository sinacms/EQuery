<?php
namespace equery\dsl\term;

class terms extends \equery\dsl\dsla  {
    public function __construct($k, $v) {
        $this->obj['terms'] = array($k => $v);
    }
}
