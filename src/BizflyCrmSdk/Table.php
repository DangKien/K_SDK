<?php

namespace BizflyCrmSdk;

use BizflyCrmSdk\Helper\Http;

Class Table
{
    /**
     * @param $path
     * @param $params
     * @param $headers
     * @return mixed
     */
    public function find($path, $params, $headers) {
        return Http::getInstance()->post($path, $params);
    }

    public function update () {

    }

    public function createLists() {

    }

    public function getLists() {

    }

    public function createField () {

    }

    public function getStruct() {

    }
}