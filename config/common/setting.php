<?php

return [

        'chat_enabled' => env('CHAT_ENABLED', 0),
        'video_call_enabled' => env('VIDEO_CALL_ENABLED', 0),
        'watermark' => env('WATERMARK', 0),
        'send_mail' => env('SEND_EMAIL', 0),
        'enable_captcha' => env('ENABLE_CAPTCHA', 0),
        'google_captcha_key' => env('GOOGLE_CAPTCHA_KEY', 0),
];