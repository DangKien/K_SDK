<?php

namespace BizflyCrmSdk\Helper;

use Cassandra\Date;

class Http
{
    /**
     * Singleton Object
     *
     * @var $this
     */
    private static $instance;

    const HTTP_METHOD_POST = 'POST';
    const HTTP_METHOD_GET = 'GET';

    const HTTP_CONTENT_TYPE_JSON = 'application/json';

    private $url = 'https://crmbizfly.todo.vn/_api/';
    private $headers;

    function __construct() {
        $this->headers['Content-Type'] = self::HTTP_CONTENT_TYPE_JSON;
        $this->headers['cb-access-timestamp'] = time();
    }

    /**
     * Returns the singleton object
     *
     * @return $this
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     *
     * @param $path
     * @param array $params
     * @param string $method
     * @param array $headers
     * @return mixed
     */
    private function _pushBody($path, $params = [], $method = 'GET', $headers = []) {

        $API_URL = $this->getUrl($path);
        $API_HEADERS = $this->_getHeader($headers);

        // Tạo mới curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $API_URL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        // Nếu là method POST thì thêm dữ liệu gửi đi
        if (in_array(strtolower($method), [strtolower(self::HTTP_METHOD_POST)])) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        }
        // Thêm Header
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->_getHeader());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        // Đóng Curl
        curl_close($ch);
        return json_decode($result, true);
    }

    /**
     * Lấy URL API
     * @param string $path
     * @return $url
     */
    public function getUrl($path = '') {
        return $this->url.$path;
    }

    /**
     * Lấy Header
     * @param array $headers
     * @return array
     */
    private function _getHeader($headers = []) {
        $newHeaders = $this->headers;
        if (!empty($headers)) {
            $newHeaders = array_replace_recursive($this->headers, $headers);
        }
        $retData = [];
        foreach($newHeaders as $key => $val) {
            $retData[] = "$key: $val";
        }
        return $retData;
    }

    /**
     * tao header cho http request
     * @param array $headers key => val
     * @param bool $merge
     * @return Http
     */
    public function setHeader($headers = [], $merge = true) {
        if ($merge) {
            $this->headers = array_merge($this->headers, $headers);
        } else {
            $this->headers = $headers;
        }
        return $this;
    }

    /**
     * Thực hiện method GET
     * @param $path
     * @param array $headers
     *  @return mixed
     */
    public function get($path, $headers = []) {
        return $this->_pushBody($path, [], self::HTTP_METHOD_GET,  $headers);
    }

    /**
     * Thực hiện method POST
     * @param $path
     * @param array $data
     * @param array $headers
     * @return mixed
     */
    public function post($path, $data = [], $headers = []) {
        return $this->_pushBody($path, $data, self::HTTP_METHOD_POST, $headers);
    }


}
