<?php


namespace equery\dsl\compound;
use equery\dsl;
use equery\equeryException;

class functionscore extends \equery\dsl\dsla  {
    public function __construct($dsl) {
        $this->obj['function_score'] = ["query" => $dsl];
    }

    public function ScriptScore($source, $params = null) {
        $script = array(
            "source" => $source
        );
        if (!empty($params)) {
            $script['params'] = $params;
        }
        $this->obj['function_score']['script_score'] = ['script' => $script];
    }
}

