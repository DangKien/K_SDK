<?php
/**
 * Created by ngankt2@gmail.com
 * Website: https://techhandle.net
 */


namespace BizflyHelperSdk;


class ConfigHelper
{
    static private $instance = false;
    private $configs = [];

    public function __construct($configs)
    {
        $this->configs = $configs;
        self::$instance = &$this;
    }
    public static function &getInstance()
    {
        return self::$instance;
    }
    /**
     * @param $key
     * @param bool $default
     * @return bool|mixed|string
     */
    public function getConfig($key, $default = false)
    {
        if (isset($this->configs[$key])) {
            return $this->configs[$key];
        } else {
            return $default;
        }
    }
    public function getConfigs(){
        return $this->configs;
    }

}