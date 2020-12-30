<?php


namespace equery\dsl\text;
use equery\dsl;

/*
 * example:
 * {
 *      "match_phrase_prefix" : {
 *          "message": {
 *              "query": "quick brown f",
 *              "analyzer": "ik_smart",
 *              "max_expansions":50,
 *              "slop": 2
 *          }
 *      }
 * }
 */
class matchphraseprefix extends \equery\dsl\dsla  {
    public function __construct($k, $v) {
        $this->obj['match_phrase_prefix'] = array($k => $v);
    }
}
