<?php
namespace EQuery\dsl;
use EQuery\dsl;

class match_all extends \EQuery\dsl\dsla  {
    public function __construct() {
        $this->obj['match_all'] = new \stdclass();
    }
}
