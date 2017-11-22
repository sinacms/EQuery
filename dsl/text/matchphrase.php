<?php


namespace EQuery\dsl\text;
use EQuery\dsl;

class matchphrase extends \EQuery\dsl\dsla  {
    public function __construct($k, $v) {
        $this->obj['match_phrase'] = array($k => $v);
    }
}
