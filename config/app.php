<?php

return [
    "debug" => env('APP_DEBUG', true),
    "midtrans" => [
        "merchant_id" => env("MIDTRANS_MERCH_ID", ""),
        "client_key" => env("MIDTRANS_CLIENT_KEY", ""),
        "server_key" => env("MIDTRANS_SERVER_KEY", ""),
        "is_production" => env("MIDTRANS_IS_PRODUCTION", false),
        "is_sanitized" => env("MIDTRANS_IS_SANITIZED", true),
    ]
];
