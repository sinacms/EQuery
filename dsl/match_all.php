<?php
namespace equery\dsl;
use equery\dsl;

class match_all extends \equery\dsl\dsla  {
    public function __construct() {
        $this->obj['match_all'] = new \stdclass();
    }
}
