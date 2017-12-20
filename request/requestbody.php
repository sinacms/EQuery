<?php
namespace EQuery\request;
use EQuery\dsl;
use EQuery;
use EQuery\EQueryException;


// here $obj is always a map; no php class/obj
class requestbody {
    public $obj;
    public function __construct() {
    }
    public function Query($dsl) {
        if (!($dsl instanceof \EQuery\dsl\dsla)) {
            throw new EQueryException("EQuery add query accepts only dsl, but received:", print_r($dsl));
        }
        $this->obj["query"] = $dsl->ToArray();
        return $this;
    }

    public function From($from) {
        $this->obj['from'] = $from;
        return $this;
    }

    public function Size($size) {
        $this->obj['size'] = $size;
        return $this;
    }

    public function Source($source) {
        $this->obj['_source'] = $source;
        return $this;
    }

    public function Sort($sort) {
        $this->obj['sort'] = $sort;
        return $this;
    }

    public function SearchAfter($expr) {
        $this->obj['search_after'] = $expr;
        return $this;
    }

    public function Scroll($expr) {
        $this->obj['scroll'] = $expr;
        return $this;
    }

    public function ToArray() {
        return $this->obj;
    }

    public function ToJson() {
        return json_encode($this->ToArray());
    }
}

