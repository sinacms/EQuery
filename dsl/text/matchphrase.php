<?php


namespace equery\dsl\text;
use equery\dsl;

class matchphrase extends \equery\dsl\dsla  {
    public function __construct($k, $v) {
        $this->obj['match_phrase'] = array($k => $v);
    }
}
