<?php
namespace EQuery\dsl\term;

class exists extends \EQuery\dsl\dsla  {
    public function __construct($k) {
        $this->obj['exists'] = array("field" => $k);
    }
}
