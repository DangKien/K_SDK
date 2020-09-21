# Bizfly Sdk 
## Cài đặt

```composer log
    composer require bizflycrm/phpsdk
```

## Bizfly CRM

#### API Key: 
*Có thể lấy thông tin api [tại đây](https://crm.bizfly.vn/project/api)*
- **API_KEY**: Đây là api key do CRM Bizfly cung cấp.
- **API_SECRET**: Đây là đoạn mã secret do CRM Bizfly cung cấp.
- **API_EMBED**: Đây là đoạn mã embed do CRM Bizfly cung cấp.
- **PROJECT_TOKEN**:  Đây là project token do My Bizfly cung cấp. Dùng cho toàn bộ giải pháp của Bizfly. Có thể lấy

#### Khởi tạo Client SDK
```php
    use BizflyCrmSdk\CrmClient;
    $config = [
        'api_key' => API_KEY,
        'api_secret' => API_SECRET,
        'api_embed' => API_EMBED,
        'project_token' => PROJECT_TOKEN,
    ];
    $client = new CrmClient($config);
```
### Lấy đối tượng khách hàng
```php
    $customer = $client->getTableCustomer();
```
#### Lấy danh sách khách hàng: `find()`
```php
     $customer->find([
            'limit' => 100,
            'skip' => 0,
            'select' => ["name", "created_at"],
            'output' => "default",
        ]);
```
#### Tìm kiếm khách hàng theo ID: `find()`
```php
     $customer->find([
            'limit' => 100,
            'skip' => 0,
            'query' => [
                'id' => ['id_ban_ghi']
            ],
            'select' => ["name", "created_at"],
            'output' => "default",
        ]);
```
#### Thêm mới bản ghi khách hàng: `update()`
```php
    $customer->update([
            "data" => [
                [
                    "fields" => [
                        [
                            "key" => "name",
                            "value" => "Nguyễn Duy Sự"
                        ],
                        [
                            "key" => "emails",
                            "value" => [
                                [
                                    "value" => "su.nguyenduy.api1@gmail.com"
                                ]
                            ]
                        ],
                        [
                            "key" => "phones",
                            "value" => [
                                [
                                    "value" => "0987654321"
                                ],
                                [
                                    "value" => "0987654322"
                                ]
                            ]
                        ]

                    ],
                ]
            ]
    ]);
```
#### Cập nhật bản ghi khách hàng theo ID: `id: ''`
```php
    $customer->update([
            "data" => [
                [
                    "fields" => [
                        [
                            "key" => "name",
                            "value" => "Nguyễn Duy Sự"
                        ],
                        [
                            "key" => "emails",
                            "value" => [
                                [
                                    "value" => "su.nguyenduy.api1@gmail.com"
                                ]
                            ]
                        ],
                        [
                            "key" => "phones",
                            "value" => [
                                [
                                    "value" => "0987654321"
                                ],
                                [
                                    "value" => "0987654322"
                                ]
                            ]
                        ]

                    ],
                    "id" => 'id_ban_ghi_can_update'
                ]
            ]
    ]);
```
#### Cập nhật bản ghi khách hàng nếu trùng: `mapingBy: []`
- *Nếu bản ghi trùng email và phones thì cập nhật lại bản ghi cũ*
```php
    $customer->update([
            "data" => [
                [
                    "mapingBy" => ["emails", "phones"],
                    "fields" => [
                        [
                            "key" => "name",
                            "value" => "Nguyễn Duy Sự"
                        ],
                        [
                            "key" => "emails",
                            "value" => [
                                [
                                    "value" => "su.nguyenduy.api1@gmail.com"
                                ]
                            ]
                        ],
                        [
                            "key" => "phones",
                            "value" => [
                                [
                                    "value" => "0987654321"
                                ],
                                [
                                    "value" => "0987654322"
                                ]
                            ]
                        ]

                    ],
                    "id" => 'id_ban_ghi_can_update'
                ]
            ]
    ]);
```
#### Lấy thông tin các trường dữ liệu trong bảng khách hàng: `struct()`
```php
    $customer->struct();
```
#### Thêm mới các trường dữ liệu bảng khách hàng: `addFields()`
 ```php
       $customer->addFields([
            "data" => [
            "fields" => [
                    [
                        "key" => "field_1",
                        "type" => "string",
                        "label" => "Trường thứ 1",
                        "description" => "Mô tả trường thứ 1"
                    ],
                    [
                        "key" => "field_2",
                        "type" => "array-object",
                        "label" => "Trường thứ 2",
                        "description" => "Mô tả trường thứ 2"
                    ],
                ]
            ]
        ]);
 ```
#### Lấy 'danh sách' trong bảng khách hàng: `getLists()`
```php
    $customer->getLists([
        'limit' => 100,
        'skip' => 0,
        'output' => "default",
        'sort' => [
            'count' => 1
        ]   
    ]);
```
#### Thêm 'danh sách' trong bảng khách hàng: `addLists()`
```php
    $customer->addLists([
        "data" => [
            [
                "value" => "Danh sách 1"
            ],
            [
                "value" => "Danh sách 2"
            ]
        ]
    ]);
```

### Lấy đối tượng Deal
```php
    $deal = $client->getTableDeal();
```
#### Lấy danh sách Deal: `find()`
```php
     $deal->find([
        'limit' => 100,
        'skip' => 0,
        'select' => ["name", "created_at"],
        'output' => "default",
     ]);
```
#### Tìm kiếm Deal theo ID: `find()`
```php
     $deal->find([
            'limit' => 100,
            'skip' => 0,
            'query' => [
                'id' => ['id_ban_ghi']
            ],
            'select' => ["name", "created_at"],
            'output' => "default",
        ]);
```
#### Thêm mới bản ghi Deal: `update()`
```php
    $deal->update([
            "data" => [
                [
                    "fields" => [
                        [
                            "key" => "name",
                            "value" => "Deal Test"
                        ],
                        [
                            "key" => "customer",
                            "value" => [
                                    [
                                        "id" => "5e967a9f84f36615d4007365"
                                    ]
                            ]
                        ],
                        [
                            "key" => "code",
                            "value" => "05182020"
                        ],  
                        [
                            "key" => "sale",
                            "value" => [
                                [
                                    "id" => "5e8ed4245adfc61f960fb793"
                                ]           
                            ]
                        ],
                        [
                             "key" => "amount",
                             "value" => 10000000
                        ],
                        [
                            "key" => "rating",
                            "value" => 90
                        ],
                    ],
                ]
            ]
    ]);
```
#### Cập nhật bản ghi Deal theo ID: `id: ''`
```php
    $deal->update([
            "data" => [
                [
                    "fields" => [
                        [
                            "key" => "name",
                            "value" => "Deal Test"
                        ],
                        [
                            "key" => "customer",
                            "value" => [
                                    [
                                        "id" => "5e967a9f84f36615d4007365"
                                    ]
                            ]
                        ],
                        [
                            "key" => "code",
                            "value" => "05182020"
                        ],  
                        [
                            "key" => "sale",
                            "value" => [
                                [
                                    "id" => "5e8ed4245adfc61f960fb793"
                                ]           
                            ]
                        ],
                        [
                             "key" => "amount",
                             "value" => 10000000
                        ],
                        [
                            "key" => "rating",
                            "value" => 90
                        ],
                    ],
                    "id" => "id_ban_ghi_cap_nhat"
                ]
            ]
    ]);
```
#### Cập nhật bản ghi Deal nếu trùng: `mapingBy: []`
- *Nếu bản ghi trùng code thì cập nhật lại bản ghi cũ*
```php
    $deal->update([
            "mappingBy" => ["code"],
            "data" => [
                [
                    "fields" => [
                        [
                            "key" => "name",
                            "value" => "Deal Test"
                        ],
                        [
                            "key" => "customer",
                            "value" => [
                                    [
                                        "id" => "5e967a9f84f36615d4007365"
                                    ]
                            ]
                        ],
                        [
                            "key" => "code",
                            "value" => "05182020"
                        ],  
                        [
                            "key" => "sale",
                            "value" => [
                                [
                                    "id" => "5e8ed4245adfc61f960fb793"
                                ]           
                            ]
                        ],
                        [
                             "key" => "amount",
                             "value" => 10000000
                        ],
                        [
                            "key" => "rating",
                            "value" => 90
                        ],
                    ],
                ]
            ]
        ]);
```
#### Lấy thông tin các trường dữ liệu trong bảng Deal: `struct()`
```php
    $deal->struct();
```
#### Thêm mới các trường dữ liệu bảng Deal: `addFields()`
 ```php
       $deal->addFields([
            "data" => [
            "fields" => [
                    [
                        "key" => "field_1",
                        "type" => "string",
                        "label" => "Trường thứ 1",
                        "description" => "Mô tả trường thứ 1"
                    ],
                    [
                        "key" => "field_2",
                        "type" => "array-object",
                        "label" => "Trường thứ 2",
                        "description" => "Mô tả trường thứ 2"
                    ],
                ]
            ]
        ]);
 ```


### Lấy đối tượng hoạt động
```php
    $activity =  $client->getTableActivity();
```
#### Lấy danh sách hoạt động: `find()`
```php
     $activity->find([
            'limit' => 100,
            'skip' => 0,
            'select' => ["name", "created_at"],
            'output' => "default",
        ]);
```
#### Tìm kiếm hoạt động theo ID: `find()`
```php
     $activity->find([
            'limit' => 100,
            'skip' => 0,
            'query' => [
                'id' => ['id_ban_ghi']
            ],
            'select' => ["name", "created_at"],
            'output' => "default",
        ]);
```
#### Thêm mới bản ghi hoạt động: `update()`
```php
    $activity->update([
        "data" => [
           'fields' => [
                [
                     "key"  => "name",
                     "value"  => "Khảo sát khách ngày 18-05-2019",
                ],
                [
                     "key" => "customer_id",
                     "value" => "5e8fdfd584f3662b2c003313",
                ],
                [
                    "key" => "emails",
                    "value" => [
                         [
                             "value" => "hieptranmanh@vccorp.vn",
                         ]
                    ]
                ],
                [
                     "key" => "phones",
                     "value" => [
                         [
                             "value" => "+84948981266",
                         ]
                     ]
                ],
                [
                     "key" => "object_name",
                     "value" => "Khảo sát về nhu cầu mua hàng",
                ],
                [
                     "key" => "object_type",
                     "value" => "survey",
                ],
                [
                     "key" => "object_type_label",
                     "value" => "Khảo sát",
                ],
                [
                     "key" => "object_id",
                     "value" => "5e8eb6fc84f3661ef4000668",
                ],
                [
                     "key" => "action",
                     "value" => "input-form",
                ],
                [
                     "key" => "action_label",
                     "value" => "Nhập form online",
                ]
            ]
        ]
    ]);
```
#### Cập nhật bản ghi hoạt động theo ID: `id: ''`
```php
    $activity->update([
         "data" => [
            "fields" => [
                [
                     "key"  => "name",
                     "value"  => "Khảo sát khách ngày 18-05-2019",
                ],
                [
                     "key" => "customer_id",
                     "value" => "5e8fdfd584f3662b2c003313",
                ],
                [
                    "key" => "emails",
                    "value" => [
                         [
                             "value" => "hieptranmanh@vccorp.vn",
                         ]
                    ]
                ],
                [
                     "key" => "phones",
                     "value" => [
                         [
                             "value" => "+84948981266",
                         ]
                     ]
                ],
                [
                     "key" => "object_name",
                     "value" => "Khảo sát về nhu cầu mua hàng",
                ],
                [
                     "key" => "object_type",
                     "value" => "survey",
                ],
                [
                     "key" => "object_type_label",
                     "value" => "Khảo sát",
                ],
                [
                     "key" => "object_id",
                     "value" => "5e8eb6fc84f3661ef4000668",
                ],
                [
                     "key" => "action",
                     "value" => "input-form",
                ],
                [
                     "key" => "action_label",
                     "value" => "Nhập form online",
                ]
            ],
            "id" => "id_ban_ghi"
        ]
    ]);
```
#### Lấy thông tin các trường dữ liệu trong bảng hoạt động: `struct()`
```php
    $activity->struct();
```


