<?php
namespace EQuery\request;
use EQuery\dsl;
use EQuery;


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
    public function FromSize($from, $size) {
        if (is_numeric($from) && is_numeric($size)) {
            $this->obj['from'] = $from;
            $this->obj['size'] = $size;
            return $this;
        }
        throw new EQuery\EQueryException("EQuery from size accepts only numerics, but received:", print_r($from, 1)." ". print_r($size, 1));
    }

    public function Source($source) {
        $this->obj['_source'] = $source;
        return $this;
    }

    public function Sort($sort) {
        $this->obj['sort'] = $sort;
        return $this;
    }

    public function ToArray() {
        return $this->obj;
    }
    public function ToJson() {
        return json_encode($this->ToArray());
    }
}

