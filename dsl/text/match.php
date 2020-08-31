<?php
namespace equery\dsl\text;
use equery\dsl;

class match extends \equery\dsl\dsla  {
    public function __construct($k, $v, $options = ["operator" => "and"]) {
        $q = ['query' => $v];
        $q = array_merge($q, $options);
        $this->obj['match'] = [
            $k => $q
        ];
    }
}
