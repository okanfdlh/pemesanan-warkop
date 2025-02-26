<?php
return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'], // Bisa diganti dengan IP Flutter jika spesifik
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => ['XSRF-TOKEN'],
    'max_age' => 0,
    'supports_credentials' => true, // Harus true untuk menangani XSRF-TOKEN
];

