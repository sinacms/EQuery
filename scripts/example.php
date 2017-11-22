<?php


include_once "bootstrap.php";

use EQuery\dsl;




$kv = new EQuery\dsl\kv("k", "v");
print_r($kv->ToJson());
print_r($kv->ToArray());
print_r($kv->Obj());
