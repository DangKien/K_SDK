<?php

namespace BizflyCrmSdk\Resources;

/**
 * todo:
 * - lấy danh sách khách hàng = done
 * - lấy chi tiết 1 bản ghi = done
 * - gán tags = todo
 * - gán list = todo
 * - lấy list = todo
 * - sửa bản ghi theo email = todo
 * - sửa bản ghi theo phone = todo
 * - sửa bản ghi theo id = done
 * - lấy bản ghi theo email = getCustomersByEmail() => trả về 1 danh sách nhiều bản ghi
 * - lấy bản ghi theo phone = getCustomersByPhone() => trả về 1 danh sách nhiều bản ghi
 * - lấy danh sách khách hàng theo điều kiện khác
 */
/**
 * Class Customer
 * @package BizflyCrmSdk\Resources
 */
class Customer extends Table
{
    /** @var string */
    private $table = 'data_customer';
    private $mapping = [
        'phones',
        'emails'
    ];



    public function __construct($client)
    {
        parent::__construct($this->table,$client);
    }
    //function riêng nữa cho riêng customer
    /**
     *
     */



}
