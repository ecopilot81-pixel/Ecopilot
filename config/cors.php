<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    // Conserva Sanctum y agrega las rutas web usadas por la sesión propia de React.
    'paths' => ['v1/*', 'sanctum/csrf-cookie', 'csrf-token', 'login', 'logout', 'me', 'my-profile', 'my-collection'],

    'allowed_methods' => ['*'],

    // Limita las cookies de sesión a los orígenes locales conocidos de Vite.
    'allowed_origins' => explode(',', env(
        'CORS_ALLOWED_ORIGINS',
        'http://localhost:5173,http://localhost:5174,http://127.0.0.1:5173,http://127.0.0.1:5174'
    )),

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // Permite enviar y recibir la cookie de sesión en las solicitudes del frontend.
    'supports_credentials' => true,

];
