<?php
namespace equery\dsl\term;

class term extends \equery\dsl\dsla  {
    public function __construct($k, $v) {
        $this->obj['term'] = array($k => $v);
    }
}
