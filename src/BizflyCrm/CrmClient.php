<?php
/**
 * Created by ngankt2@gmail.com
 * Website: https://techhandle.net
 */

namespace BizflyCrm;

use App\Elibs\Debug;
use BizflyCrm\Enum\ErrorCode;
use BizflyCrm\Resources\Customer;
use BizflyCrm\Resources\Deal;
use BizflyCrm\Resources\Field;
use BizflyCrm\Resources\Product;
use BizflyHelper\AuthHelper;
use BizflyHelper\ConfigHelper;
use BizflyHelper\DebugHelper;
use BizflyHelper\RequestHelper;
use BizflyCrm\Resources\Table;
use BizflyHelper\StringHelper;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerInterface;

/**
 * BizflyCrm\CrmClient
 * Đối tượng chứa các hàm liên quan đến API CRM
 */
class CrmClient
{
    const VERSION = '1.0';

    public $auth;
    private $project_token = '';
    public $configs;
    public $request;


    static private $instance = false;

    public function __construct($configs = [], $project_token = '') {
        if ($project_token && (!isset($configs['project_token']) || !$configs['project_token'])) {
            $configs['project_token'] = $project_token;
        }
        $this->project_token = $configs['project_token'];
        $configs['sdk_version'] = self::VERSION;
        $this->configs = new ConfigHelper($configs);
        $this->auth = new AuthHelper($configs);
        $this->request = new RequestHelper($this->auth, $this->configs);
        $apiUrl = $this->configs->getConfig('sdk_domain');
        $this->request->setApiUrl($apiUrl);
        self::$instance = &$this;

    }

    public static function &getInstance() {
        return self::$instance;
    }

    /**
     * Lấy bảng dữ liệu
     * @param string $table
     * @return Table
     */
    public function getTable($table) {
        return new Table($table,$this);
    }

    /**
     * Lấy bảng dữ liệu khách hàng: data_customer
     * @return string
     */
    public function getTableCustomer() {
        return new Customer($this);
    }

    /**
     * Lấy bảng dữ liệu đơn hàng: data_deal
     * @return string
     */
    public function getTableDeal() {
        return new Deal($this);
    }

    /**
     * Lấy bảng dữ liệu sản phẩm: data_product
     * @return string
     */
    public function getTableProduct() {
        return new Product($this);
    }

    /**
     * Lấy bảng dữ liệu hoạt động: data_activity
     * @return string
     */
    public function getTableActivity() {
        return new Deal($this);

    }


}


