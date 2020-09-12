# Bizfly Sdk 



## Bizfly CRM

#### API Key
- **API_KEY**: Đây là api key do CRM Bizfly cung cấp. Có thể lấy [tại đây](https://crm.bizfly.vn/project/api)
- **API_SECRET**: Đây là đoạn mã secret do CRM Bizfly cung cấp. Có thể lấy [tại đây](https://crm.bizfly.vn/project/api)
- **API_EMBED**: Đây là đoạn mã embed do CRM Bizfly cung cấp. Có thể lấy [tại đây](https://crm.bizfly.vn/project/api)
- **PROJECT_TOKEN**:  Đây là project token do My Bizfly cung cấp. Dùng cho toàn bộ giải pháp của Bizfly. Có thể lấy [tại đây](https://crm.bizfly.vn/project/api)

#### Khởi tạo Client SDK
```php
    use BizflyCrmSdk\CrmClient;
    $config = [
        'api_key' => API_KEY,
        'project_token' => PROJECT_TOKEN,
        'api_secret' => API_SECRET,
        'api_embed' => API_EMBED,
    ];
    $client = new CrmClient(API_KEY, API_SECRET, API_EMBED, PROJECT_TOKEN);
```

#### Lấy bảng dữ liệu: `getTable`
- **Table**: Bảng dữ liệu muốn lấy: data_customer,...
```php
     $client->getTable(Table);
```

#### -`getTableCustomer: $client->getTableCustomer();`
#### -`getTableDeal: $client->getTableDeal();`
#### -`getTableProduct: $client->getTableProduct();`
#### -`getTableActivity: $client->getTableActivity();`

#### Tìm kiếm hoặc lấy danh sách bản ghi: `find()`

```php
     $client->getTable(Table)->find(body);
```
Trong đó body là một mảng
Ví dụ:
```php
      $body = [
          'limit' => 100,
          'skip' => 0,
          'query' => [
               'id' => ['id_ban_ghi']
          ],
          'select' => ["name", "created_at"],
          'output' => "default",
      ];
```
- *limit*: Giới hạn số bản ghi nhận về. Giá trị mặc định: 1000
- *skip*: Bắt đầu từ bản ghi thứ. Giá trị mặc định: 0
- *query*: Một mảng id hoặc id 
- *select*: Trường dữ liệu được lấy về
- *output*: Có 3 giá trị: "*default*", "*by-key*", "*count-only*". Giá trị mặc định là "*default*"

#### Thêm mới hoặc cập nhật bản ghi: `update()`

```php
     $client->getTable(Table)->update(body);
```
Trong đó body là một mảng
Ví dụ:
```php
      $body = [
          "mappingBy" => ["name"],
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
                  "activity" => [
                      "object_name" => "Đăng ký form tư vấn ngày 18-05-2020",
                      "object_type" => "customer",
                      "object_type_label" => "Khách hàng",
                      "action" => "dang-ky-form",
                      "action_label" => "Đăng ký form",
                      "object_tag" => [
                          ["key" => "link", "value" => "https://link-form-popup.com/form"],
                          ["key" => "link", "value" => "https://link-form-popup.com/form"]
                      ]
                  ]
              ]
          ]
      ];
```
- *mappingBy*: 
    -   Là các trường sẽ sử dụng để merge dữ liệu, mappingBy là array của các string hoặc là array của các array bao gồm string. Việc mapping sẽ đi từ trái sang phải,với trường mapping đầu tiên mà không tìm thấy, thì sẽ tiếp tục mapping với giá trị thứ 2 trong mappingBy, nếu giá trị trong mapping là array, thì sẽ mapping theo điều kiện của các giá trị trong mảng.
    -   Nếu tìm thấy bản ghi theo trường trong mappingBy sẽ update bản ghi đó. Nếu không tìm thấy sẽ tiến hành tạo bản ghi mới.
- *mergingFieldBy*: Được sử dụng khi trường dữ liệu là 1 array-object, và mình muốn gộp, check trùng các item của array-object đó. mergeFieldBy là 1 object với các key là các key tương ứng với trường mà mình update dữ liệu, value là array bao gồm các key trong item mà mình sẽ dùng để so sánh.
- *updateEmptyField*: Trong một số trường bạn không tích hợp mà không muốn cập nhật dữ liệu thành bị rỗng ví dụ "", [], {},undefined,null (với dữ liệu số là 0 và boolean là false sẽ không được tính) thì updateEmptyField =false.Mặc định là true và khi đó hệ thống sẽ cập nhật tất cả các trường mà bạn gửi lên, bao gồm dữ liệu rỗng.
- *data*: Là một array trong đó:
    - *fields*: Một mảng id hoặc id 
    - *activity*: Một mảng id hoặc id 
        -  *activity_id*: Là id của hành động, trong trường hợp không cần mapping có thể bỏ qua trường này
        -  *object_name*: Là tên của hành động
        -  *object_type*: Đối tượng của hành động
        -  *object_type_label*: Phần text hiển thị đối tượng của hành động
        -  *action*:  Là hành động
        -  *action_label*: Là phần text hiển hành động
        -  *object_tag*: Là những thông tin bổ sung thêm cho hành động
    - *id*: id của bản ghi nếu có
    - *automation_data*: 
        - switcher_name: Tên của automation.
        - key_data: Dữ liệu tương ứng


#### Lấy thông tin các trường dữ liệu trong bảng: `struct()`

```php
     $client->getTable(Table)->struct();
```

#### Thêm trường dữ liệu trong bảng: `addFields()`

```php
     $client->getTable(Table)->addFields(body);
```
Trong đó body là một mảng
Ví dụ:
```php
      $body = [
          "data" => [
              "fields" => [
                   [
                       "key" => "dia-chi_test",
                       "type" => "string-object",
                       "label" => "Địa chỉ",
                       "description" => "Địa chỉ của bạn"
                   ]
               ]
           ]
      ];
```
- *fields*: Gồm một mảng chứa các trường cần thêm mới theo cấu trúc.
- *key*: Key trường dữ liệu.
- *type*: Kiểu dữ liệu CRM Bizfly cho phép.
- *label*: Tên hiện thị trường dữ liệu.
- *description*: Mô tả trường dữ liệu.

#### Lấy 'danh sách' trong bảng: `getLists()`

```php
     $client->getTable(Table)->getLists(body);
```
Trong đó body là một mảng
Ví dụ:
```php
      $body = [
          'limit' => 100,
          'skip' => 0,
          'select' => ["name", "created_at"],
          'output' => "default",
           'sort' => [
                'count' => 1
            ]   
      ];
```
- *limit*: Giới hạn số bản ghi nhận về. Giá trị mặc định: 1000
- *skip*: Bắt đầu từ bản ghi thứ. Giá trị mặc định: 0
- *sort*: Sắp xếp bản ghi theo thứ tự. count: Chỉ có giá trị: 1, -1. Mặc định là -1
- *select*: Trường dữ liệu được lấy về
- *output*: Có 3 giá trị: "*default*", "*count-only*". Giá trị mặc định là "*default*"

