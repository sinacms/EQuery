<?php
namespace EQuery\dsl;

class kv extends dsla  {
    public function __construct() {
    }

    public function kv($k, $v) {
        $this->obj[$k] = $v;
        return $this;
    }
}
