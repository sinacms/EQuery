<?php
namespace EQuery\dsl\term;

class wildcard extends \EQuery\dsl\dsla  {
    public function __construct($k, $v) {
        $this->obj['wildcard'] = array($k => $v);
    }
}
