<?php
/**
 * Created by ngankt2@gmail.com
 * Website: https://techhandle.net
 */

namespace BizflyHelperSdk;

class AuthHelper
{
    private $apiKey;
    private $apiSecret;
    private $apiEmbedKey;
    private $projectToken;
    static private $instance = false;

    public function __construct($configs = [], $apiKey = '', $apiSecret = '', $apiEmbedKey = '', $projectToken = '')
    {
        if (isset($configs['api_key'])) {
            $apiKey = $configs['api_key'];
        }
        if (isset($configs['api_embed_key'])) {
            $apiEmbedKey = $configs['api_embed_key'];
        }
        if (isset($configs['api_secret'])) {
            $apiSecret = $configs['api_secret'];
        }
        if (isset($configs['project_token'])) {
            $projectToken = $configs['project_token'];
        }
        if (!$projectToken) {

        }
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->apiEmbedKey = $apiEmbedKey;
        $this->projectToken = $projectToken;
        self::$instance = &$this;
    }

    public static function &getInstance($source)
    {
        return self::$instance;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getApiEmbedKey()
    {
        return $this->apiEmbedKey;
    }

    public function setApiEmbedKey($value)
    {
        $this->apiEmbedKey = $value;
    }

    public function getApiSecret()
    {
        return $this->apiSecret;
    }

    public function setApiSecret($apiSecret)
    {
        $this->apiSecret = $apiSecret;
    }

    public function getRequestHeaders($method, $path, $body)
    {
        $timestamp = $this->getTimestamp();
        $signature = $this->getHash('sha512', $timestamp . $this->projectToken, $this->apiSecret);
        return [
            'CB-ACCESS-KEY' => $this->apiKey,
            'CB-PROJECT-TOKEN' => $this->projectToken,
            'CB-ACCESS-SIGN' => $signature,
            'CB-ACCESS-TIMESTAMP' => $timestamp,
            'DEBUG' => false,
        ];
    }

    // protected

    protected function getTimestamp()
    {
        return time() * 1000;
    }

    /***
     * @param $params
     */
    public function buildTokenUrl($params)
    {
        $signature = $this->getHash('sha512', http_build_query($params), $this->apiSecret);
        return $signature;
    }

    protected function getHash($algo, $data, $key)
    {
        return hash_hmac($algo, $data, $key);
    }
}