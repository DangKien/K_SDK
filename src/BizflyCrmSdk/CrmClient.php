<?php

namespace BizflyCrmSdk;

use App\Elibs\Debug;
use BizflyCrmSdk\Enum\ErrorCode;
use BizflyCrmSdk\Resources\Activity;
use BizflyCrmSdk\Resources\Customer;
use BizflyCrmSdk\Resources\Deal;
use BizflyCrmSdk\Resources\Field;
use BizflyCrmSdk\Resources\Product;
use BizflyHelperSdk\AuthHelper;
use BizflyHelperSdk\ConfigHelper;
use BizflyHelperSdk\DebugHelper;
use BizflyHelperSdk\RequestHelper;
use BizflyCrmSdk\Resources\Table;
use BizflyHelperSdk\StringHelper;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerInterface;

/**
 * BizflyCrmSdk\CrmClient
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
        if (empty($configs['sdk_domain'])) {
            $configs['sdk_domain'] = 'https://crm.bizfly.vn/';
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
        return new Activity($this);

    }


}


