<?php
namespace EQuery\dsl\term;

class termrange extends dsla  {
    public function __construct($k, $v) {
        $this->obj['range'] = array($k => $v);
    }
}
