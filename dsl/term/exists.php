<?php
namespace equery\dsl\term;

class exists extends \equery\dsl\dsla  {
    public function __construct($k) {
        $this->obj['exists'] = array("field" => $k);
    }
}
