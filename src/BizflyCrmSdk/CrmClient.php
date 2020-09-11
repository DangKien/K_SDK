<?php

namespace BizflyCrmSdk;

use BizflyCrmSdk\Helper\Http;

class CrmClient
{

    private $project_token = '';
    private $api_key = '';
    private $api_secret = '';
    private $api_embed = '';

    private $arrPath = [
        'find' => 'base-table/find',
        'update' => 'base-table/update',
        'struct' => 'base-table/struct',
        'getList' => 'base-table/get-lists',
        'createList' => 'base-table/add-lists',
        'createFields' => 'base-table/add-fields',
    ];

    /** API function.
     * @param $table: Tên bảng
     * @param $options: Mảng chưa headers và body
     * @method find(string $table, array $options = [])
     * @method update(string $table, array $options = [])
     * @method struct(string $table, array $options = [])
     * @method getList(string $table, array $options = [])
     * @method createList(string $table, array $options = [])
     * @method createFields(string $table, array $options = [])
     */

    public function __construct($project_token = '', $configs = []) {
        $this->project_token = $project_token;
        $this->api_key = $configs['api_key'];
        $this->api_secret = $configs['api_secret'];
        $this->api_embed = $configs['api_embed'];
        $headers = [
            'cb-access-key' => $configs['api_key'],
            'cb-project-token' => $project_token,
            'cb-access-sign' => hash_hmac('sha512', time() . $project_token, $configs['api_secret'])
        ];
        Http::getInstance()->setHeader($headers);
    }

    /**
     * Call đến api theo
     * @param string $name , $arg
     * @return $url
     */
    public function __call($name, $args = []) {
        if (isset($name)) {
            if (!empty($args[0])) {
                return $this->_callAPI($name, $args[0], @$args[1]);
            }
        } else {
            return false;
        }
    }

    public static function __callStatic($name, $arguments) {

    }

    public function _callAPI ($api, $table = '',  $options) {
        if (isset($this->arrPath[$api])) {
            $path = $this->arrPath[$api];
            $body = isset($options['body']) ? $options['body'] : [];
            $headers = isset($options['headers']) ? $options['headers'] : [];

            $params = ['table' => $table];
            $params = array_merge($params, $body);

            return Http::getInstance()->post($path, $params, $headers);
        } else {
            return false;
        }
    }


//    public function find($table = '', $options = []) {
//        $path = 'base-table/find';
//        $body = isset($options['body']) ? $options['body'] : [];
//        $headers = isset($options['headers']) ? $options['headers'] : [];
//
//        $params = ['table' => $table];
//        $params = array_merge($params, $body);
//
//        return Http::getInstance()->post($path, $params, $headers);
//    }
//
//    public function update($table = '', $options = []) {
//        $path = 'base-table/update';
//        $body = isset($options['body']) ? $options['body'] : [];
//        $headers = isset($options['headers']) ? $options['headers'] : [];
//
//        $params = ['table' => $table];
//
//        $params = array_merge($params, $body);
//
//        return Http::getInstance()->post($path, $params, $headers);
//    }
//
//    public function createList($table, $options = []) {
//
//        $path = 'base-table/add-lists';
//
//        $body = isset($options['body']) ? $options['body'] : [];
//        $headers = isset($options['headers']) ? $options['headers'] : [];
//
//        $params = ['table' => $table];
//
//        $params = array_merge($params, $body);
//
//        return Http::getInstance()->post($path, $params, $headers);
//    }
//
//    public function getList($table, $options = []) {
//        $path = 'base-table/get-lists';
//
//        $body = isset($options['body']) ? $options['body'] : [];
//        $headers = isset($options['headers']) ? $options['headers'] : [];
//
//        return Http::getInstance()->post($path, $params, $headers);
//    }
//
//    public function addFields ($table, $options = []) {
//        $path = 'base-table/add-fields';
//
//        $body = isset($options['body']) ? $options['body'] : [];
//        $headers = isset($options['headers']) ? $options['headers'] : [];
//
//        return Http::getInstance()->post($path, $params, $headers);
//    }
}