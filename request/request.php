<?php



namespace EQuery\request;

// http protocol
// if not convenient, one could do the request himself;

class request {
    public $host;
    public $port;
    public $path = "/_search";  // do not change the protocol, use midlleware;
    public function __construct($infos) {
        if (empty($infos["host"]) || empty($infos["port"])) {
            throw new EQueryException("new Equery\request\request err: empty host or port". print_r($infos, 1));
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

