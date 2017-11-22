<?php
namespace EQuery\dsl\text;
use EQuery\dsl;

class match extends \EQuery\dsl\dsla  {
    public function __construct($k, $v) {
        $this->obj['match'] = array($k => $v);
    }
}
