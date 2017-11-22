<?php



namespace EQuery\request;

// http protocol
// if not convenient, one could do the request himself;

class request {
    public $host;
    public $port;
    public $path = "/_search";  // do not change the protocol, use midlleware;
    public function __construct($host, $port) {
        $this->host = $host;
        $this->port = $port;
    }

    public function doSearch($requestbody) {
        $data = $requestbody->ToJson();
        $options = array();
        $url = $this->host .":". $this->port. $this->path;
        $options = [CURLOPT_CUSTOMREQUEST => "GET", CURLOPT_POSTFIELDS => $data, CURLOPT_TIMEOUT => 5, CURLOPT_URL => $url, CURLOPT_HTTPHEADER => array("Content-Type: application/json")];
        //print_r($url);
        //print_r($data);
        $curl = curl_init(); curl_setopt_array($curl, $options); $result = curl_exec($curl); $httpInfo = curl_getinfo($curl);
        print_r($result);
        echo "\n";
        echo "\n";
        echo "\n";
        echo "\n";
        echo "\n";
        //print_r($httpInfo);
    }
}

