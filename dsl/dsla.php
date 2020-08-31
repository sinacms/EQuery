<?php
namespace equery\dsl;

// domain specific language abstract class
abstract class dsla{
    public $obj;
    public function ToJson() {
        return json_encode($this->ToArray());
    }
    public function ToArray() {
        // 深度优先遍历
        return self::deepin($this->obj);
    }
    public static function deepin($value) {
        if ($value instanceof dsla) {
            return $value->ToArray();
        }
        $arr = array();
        if (is_array($value)) {
            foreach ($value as $k => $v) {
                $arr[$k] = self::deepin($v);
            }
            return $arr;
        }
        return $value;
    }
    public function Obj() {
        return $this->obj;
    }
}
