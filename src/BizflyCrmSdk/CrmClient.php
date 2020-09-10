<?php

namespace BizflyCrmSdk;

use BizflyCrmSdk\Helper\Http;

class CrmClient
{

    private $project_token = '';
    private $api_key = '';
    private $api_secret = '';
    private $api_embed = '';

    public function __construct($project_token = '', $configs = []) {
        $this->project_token = $project_token;
        $this->api_key = $configs['api_key'];
        $this->api_secret = $configs['api_secret'];
        $this->api_embed = $configs['api_embed'];

        $headers = [
            'cb-access-key' => $configs['api_key'],
            'cb-project-token' => $project_token,
            'cb-access-sign' => hash_hmac('sha512',time().$project_token,$configs['api_secret'])
        ];

        Http::getInstance()->setHeader($headers);
    }

    public function findCustomer () {

    }
}