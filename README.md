# Bizfly Sdk 

## Bizfly CRM
#### API Key
- **API_KEY**: Đây là api key do CRM Bizfly cung cấp. Có thể lấy [tại đây](https://crm.bizfly.vn/project/api)
- **API_SECRET**: Đây là đoạn mã secret do CRM Bizfly cung cấp. Có thể lấy [tại đây](https://crm.bizfly.vn/project/api)
- **API_EMBED**: Đây là đoạn mã embed do CRM Bizfly cung cấp. Có thể lấy [tại đây](https://crm.bizfly.vn/project/api)
- **PROJECT_TOKEN**:  Đây là project token do My Bizfly cung cấp. Dùng cho toàn bộ giải pháp của Bizfly. Có thể lấy [tại đây](https://crm.bizfly.vn/project/api)

#### Khởi tạo Client SDK
```php
    use BizflyCrm\CrmClient;
    $config = [
        'api_key' => API_KEY,
        'API_SECRET' => API_KEY,
        'API_EMBED' => API_KEY,
        'PROJECT_TOKEN' => API_KEY,
    ];
    $client = new CrmClient(API_KEY, API_SECRET, API_EMBED, PROJECT_TOKEN);
  
```