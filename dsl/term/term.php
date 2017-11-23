<?php
namespace EQuery\dsl\term;

class term extends \EQuery\dsl\dsla  {
    public function __construct($k, $v) {
        $this->obj['term'] = array($k => $v);
    }
}
