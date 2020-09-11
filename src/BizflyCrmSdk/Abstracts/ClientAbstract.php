<?php

namespace BizflyCrmSdk;

use BizflyCrmSdk\Helper\Http;

abstract class ClientAbstract {

    private $project_token = '';
    private $api_key = '';
    private $api_secret = '';
    private $api_embed = '';
    private $crmClient;
    protected $table = '';

    public function __construct($project_token = '', $configs = []) {
        $this->project_token = $project_token;
        $this->api_key = $configs['api_key'];
        $this->api_secret = $configs['api_secret'];
        $this->api_embed = $configs['api_embed'];
    }

    public function _setClient () {
        $config = [
            'api_key' => $this->api_key,
            'api_secret' => $this->api_secret,
            'api_embed' => $this->api_embed
        ];
        $this->crmClient = new \BizflyCrmSdk\CrmClient($this->project_token, $config);
    }

    /**
     * Trả về Client CRM
     * @return bool|mixed
     */
    public function getClient() {
        return $this->crmClient;
    }

    /**
     * Trả về API Key
     * @return bool|string
     */
    public function getApiKey() {
        return $this->api_key;
    }

    /**
     * Trả về API Secret
     * @return bool|string
     */
    public function getApiSecret() {
        return $this->api_secret;
    }

    /**
     * Trả về API Embed
     * @return bool|string
     */
    public function getApiEmbed() {
        return $this->api_embed;
    }

    /**
     * Trả về API Embed
     * @return bool|string
     */
    public function getProjectToken() {
        return $this->project_token;
    }

    abstract function find();

    abstract function update($table, $fields);

    abstract function struct($table, $fields);

    abstract function createFields($table, $fields);

}