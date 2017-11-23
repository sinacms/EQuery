<?php
namespace EQuery\dsl\term;

class terms extends \EQuery\dsl\dsla  {
    public function __construct($k, $v) {
        $this->obj['terms'] = array($k => $v);
    }
}
