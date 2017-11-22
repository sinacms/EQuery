<?php
namespace EQuery\dsl\term;

class term extends dsla  {
    public function __construct($k, $v) {
        $this->obj['term'] = array($k => $v);
    }
}
