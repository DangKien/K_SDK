<?php
/**
 * Created by ngankt2@gmail.com
 * Website: https://techhandle.net
 */


namespace BizflyHelperSdk;


class StringHelper
{
    static private $instance = false;

    public function __construct()
    {

        self::$instance = &$this;
    }

    public static function &getInstance()
    {

        if (!self::$instance) {
            new self();
        }

        return self::$instance;
    }
    /**
     * @param $array
     * @return string
     * @ví dụ: $array=array(
    'attr1'=>'value1',
    'id'=>'example',
    'name'=>'john',
    'class'=>'normal'
    );
     */
    public function convertArrayToHtmlAtrr($array){

        $data = str_replace("=", '="', http_build_query($array, null, '" ', PHP_QUERY_RFC3986)).'"';
        return $data;
    }

    public function isMongoId($id){
        return  preg_match('/^[a-f\d]{24}$/i', $id);
    }
}