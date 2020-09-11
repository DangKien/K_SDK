<?php
return [
    //Config static url
    //  'sdk_domain' => env('SDK_DOMAIN', 'https://crmbizfly.todo.vn/'),
    'sdk_domain' => env('SDK_DOMAIN', 'http://localhost:6969/'),
    'chat_domain' => env('CHAT_DOMAIN', 'https://chat.todo.vn/'),

    //Config key auth
    'api_key' => env('SDK_KEY', 'Ffd54ukCntZHEFV8KpPvFTVTUJz3s6ZcCTFe46yuj'),
    'api_embed_key' => env('API_EMBED_KEY', 'JUDAeSwsSFRFfd54ukCntZHEFV8KpPvFTVTUJz3'),
    'api_secret' => env('API_SECRET', ''),

    //dành cho bên ngoài tích hợp (ngoài bizfly), thông số này có thể dc chủ doanh nghiệp copy từ tool crm qua phần cài đặt dự án => api tích hợp
    'project_token' => '',
    'debug' => true,
];

