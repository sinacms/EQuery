<?php
namespace EQuery\dsl;

class kv extends dsla  {
    public function __construct($k, $v) {
        $this->obj[$k] = $v;
    }
}
