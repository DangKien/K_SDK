<?php
/**
 * Created by ngankt2@gmail.com
 * Website: https://techhandle.net
 */

namespace BizflyCrmSdk\Resources;

use BizflyCrmSdk\Enum\ErrorCode;
use BizflyHelperSdk\RequestHelper;


class Table
{
    /** @var string */
    private $name;
    private $id;
    private $project_id;
    private $table;
    private $listFields = [];
    private $mapping = [
        'phones',
        'emails'
    ];

    private $client;

    public function __construct($table, &$client) {
        $this->client = $client;
        $this->table = $table;
    }

    /**
     * @param $client
     *
     */

    protected function setClient(&$client) {
        $this->client = $client;
    }

    /**
     * Lấy bảng hiện tại
     * @return mixed
     */
    protected function getTable() {
        return $this->table;
    }

    /**
     * Call API
     * @param $path
     * @param $body
     * @return array|\Illuminate\Support\Collection|mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function callApi($path, $body) {
        $requestHelper = new RequestHelper($this->client->auth, $this->client->configs);
        $rows = [];
        try {
            $response = $requestHelper->post($path, $body);
            $rows = $requestHelper->decode($response);
        } catch (\Exception $e) {
            $rows['status'] = ErrorCode::API_RESPONSE_FAIL;
        }
        if (isset($rows['status']) && $rows['status'] == ErrorCode::API_RESPONSE_SUCCESS) {
            if (isset($rows['data']) && is_array($rows['data'])) {
                return collect($rows['data']);
            }
        } else {
            return $rows;
        }
    }

    /**
     * Thêm mới bản ghi hoặc cập nhật bản ghi các bảng
     * @param $body
     * @return array|\Illuminate\Support\Collection|mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update($body) {
        $body['table'] = $this->getTable();
        return $this->callApi('_api/base-table/update', $body);
    }

    /**
     * Tìm kiếm 1 bản ghi hoặc nhiều bản ghi
     * @param $body
     * @return array|\Illuminate\Support\Collection|mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function find($body) {
        $body['table'] = $this->getTable();
        return $this->callApi('_api/base-table/find', $body);
    }

    /**
     * Lấy thông tin các trường trong bảng
     * @param $body
     * @return array|\Illuminate\Support\Collection|mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function struct($body) {
        $body['table'] = $this->getTable();
        return $this->callApi('_api/base-table/struct', $body);
    }

    /**
     * Thêm trường vào bảng
     * @param $body
     * @return array|\Illuminate\Support\Collection|mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addFields($body) {
        $body['table'] = $this->getTable();
        return $this->callApi('_api/base-table/struct', $body);
    }

    /**
     * Lấy danh sách
     * @param $body
     * @return array|\Illuminate\Support\Collection|mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLists($body) {
        $body['table'] = $this->getTable();
        return $this->callApi('_api/base-table/struct', $body);
    }

}