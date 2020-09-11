<?php
/**
 * Created by ngankt2@gmail.com
 * Website: https://techhandle.net
 */

require_once '../vendor/autoload.php';

$projectToken = '';

$crmClient = new BizflyCrm\CrmClient([    //Config static url
    'sdk_domain'=> env('SDK_DOMAIN', 'http://crmbizfly.todo.vn/'),

    'api_key' => env('SDK_KEY', 'Ffd54ukCntZHEFV8KpPvFTVTUJz3s6ZcCTFe46yuj'),
    'api_embed_key' => env('API_EMBED_KEY','JUDAeSwsSFRFfd54ukCntZHEFV8KpPvFTVTUJz3'),
    'api_secret' => env('API_SECRET',''),
], 'PROJECT_TOKEN');

//init table customer (ngoài ra có thể init table khác)
$customer = $crmClient->getTableCustomer();
//lấy các trường trong bảng


$customer->addFields(
    [
        [
            'label' => 'field 1',
            'key' => 'field_1',
            'type' => 'array',
        ],
        [
            'label' => 'field 2',
            'key' => 'field_2',
            'type' => 'array',
        ],
    ]
);

$update = $customer->update([
    [
        'fields' => [
            [
                'label' => 'Tên',
                'key' => 'name',
                'value' => [
                    'value' => 'Bizfly Vn'
                ],
                'type' => 'object' // trường chưa tồn tại muốn tạo mới thì cần type
            ],
            [
                'label' => 'Email',
                'key' => 'emails',
                'value' => [
                    [
                        'value' => 'bizflyvn1@vccorp.vn'
                    ],
                    [
                        'value' => 'bizflyvn2@vccorp.vn'
                    ]
                ],
                'type'
            ],
            [
                'label' => 'First name',
                'key' => 'first_name',
                'value' => [
                    'value' => 'Hieu'
                ],
                'type' => 'string-object'
            ],
            [
                'label' => 'Last name',
                'key' => 'last_name',
                'value' => [
                    'value' => 'Tran'
                ],
                'type' => 'string-object'
            ],
        ]
    ],
    [
        'fields' => [
            [
                'label' => 'Tên',
                'key' => 'name',
                'value' => [
                    'value' => 'Dev Bizfly'
                ],
                'type' => 'object'
            ],
            [
                'label' => 'Email',
                'key' => 'emails',
                'value' => [
                    [
                        'value' => 'dev1@vccorp.vn'
                    ]
                ],
            ],
            [
                'label' => 'Mid name',
                'key' => 'mid_name',
                'value' => [
                    'value' => 'Trung'
                ],
                'type' => 'string-object'
            ],
        ]
    ]
], true);
