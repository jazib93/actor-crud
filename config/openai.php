<?php

return [
    'api_key' => env('OPENAI_API_KEY'),
    'organization' => env('OPENAI_ORGANIZATION'),
    'timeout' => env('OPENAI_TIMEOUT', 30),
];
