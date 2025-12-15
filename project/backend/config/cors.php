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

    // Appliquer CORS uniquement sur les API
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // Autoriser toutes les méthodes HTTP
    'allowed_methods' => ['*'],

    // Définir les origines autorisées (frontend React)
    'allowed_origins' => ['http://localhost:3000'],

    // Patterns supplémentaires pour autoriser des origines dynamiques si besoin
    'allowed_origins_patterns' => [],

    // Autoriser tous les headers
    'allowed_headers' => ['*'],

    // Headers exposés au frontend
    'exposed_headers' => [],

    // Temps de cache du prévol CORS
    'max_age' => 0,

    // Support des cookies / auth cross-origin
    'supports_credentials' => true,

];
