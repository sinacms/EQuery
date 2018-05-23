<?php



namespace equery\request;
use \equery\equeryException;

// http protocol/ php 版本不提供其它协议
// TODO 需要做到依赖倒置

class request {
    public $host;
    public $port;
    public $path = "/_search";  // do not change the protocol, use midlleware;
    public function __construct($infos) {
        if (empty($infos["host"]) || empty($infos["port"])) {
            throw new equeryException("new equery\\equest\\equest err: empty host or port". json_encode($infos, JSON_UNESCAPED_UNICODE));
        }
        $this->host = $infos['host'];
        $this->port = $infos['port'];
        if (!empty($infos['path'])) $this->path = $infos['path'];
    }

    public function doRequest($requestbody, $opts) {
        $data = $requestbody->ToJson();
        $options = array();
        $url = $this->host .":". $this->port. $this->path;
        $options = [
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => array("Content-Type: application/json")
        ];
        $options[CURLOPT_TIMEOUT] = empty($opts["timeout"])? 5:$opts["timeout"];
        $options[CURLOPT_CUSTOMREQUEST] = empty($opts['method'])? 'GET':$opts['method'];
        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $result = curl_exec($curl);
        $httpInfo = curl_getinfo($curl);
        return array(
            "result" => $result,
            "http_info" => $httpInfo
        );
    }
}

