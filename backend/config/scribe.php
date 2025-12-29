<?php

use Knuckles\Scribe\Extracting\Strategies;
use Knuckles\Scribe\Config\Defaults;
use Knuckles\Scribe\Config\AuthIn;

/*
|--------------------------------------------------------------------------
| Scribe Configuration
|--------------------------------------------------------------------------
|
| This file configures how Scribe generates API documentation for your Laravel app.
| See full reference: https://scribe.knuckles.wtf/laravel/reference/config
|
*/

return [

    // Page title in browser tab
    'title' => 'Lending System API Documentation',

    // Short description shown at the top
    'description' => 'Complete API documentation for the lending platform (borrow/lend items).',

    // Introduction text (supports Markdown)
    'intro_text' => <<<INTRO
This API powers the Lending System platform where users can list items for rent, request loans, and chat.

**Authentication**: All protected endpoints require a Bearer token obtained from `/api/login`.

**Base URL**: `{{ config('app.url') }}/api`

<aside class="notice">
Tip: Use the "Try It Out" button to test endpoints directly in the browser.
Examples are available in JavaScript (fetch/axios) and cURL.
</aside>
INTRO,

    // Base URL used in examples and Try It Out
    'base_url' => config('app.url'),

    // Only include routes under /api/*
    'routes' => [
        [
            'match' => [
                'prefixes' => ['api/*'],
                'domains' => ['*'],
            ],
            'include' => [],
            'exclude' => [
                // 'admin.*', // if you have admin routes later
            ],
        ],
    ],

    // Use Laravel blade view for docs (better for auth and custom styling)
    'type' => 'laravel',
//    'type' => 'static',

    'theme' => 'default',

    'laravel' => [
        'add_routes' => true,
        'docs_url' => '/docs', // Access at http://127.0.0.1:8000/docs
        'assets_directory' => null,
        'middleware' => [], // Add auth middleware later if needed
    ],

    'try_it_out' => [
        'enabled' => true,
        'base_url' => null,
        'use_csrf' => false, // Not needed for Sanctum Bearer token
        'csrf_url' => null,
    ],

    // Authentication settings - VERY IMPORTANT for your Sanctum API
    'auth' => [
        'enabled' => true,
        'default' => false, // Most endpoints need auth, but some (register/login) don't
        'in' => AuthIn::BEARER->value, // Bearer token in Authorization header
        'name' => 'Authorization',
        'use_value' => env('SCRIBE_AUTH_KEY'), // Leave empty - Scribe will use placeholder
        'placeholder' => 'Bearer your_jwt_token_here',
        'extra_info' => 'Get your token by calling <code>POST /api/login</code> with username/email and password.',
    ],

    // Example languages shown in docs
    'example_languages' => [
        'bash',      // cURL
        'javascript', // fetch/axios
    ],

    // Generate Postman collection
    'postman' => [
        'enabled' => true,
    ],

    // Generate OpenAPI (Swagger) spec
    'openapi' => [
        'enabled' => true,
    ],

    // Group endpoints logically
    'groups' => [
        'default' => 'General',
        'order' => [
            'Authentication',
            'User Profile',
            'Items',
            'Listings',
            'Loans',
            'Messages & Chat',
        ],
    ],

    // Logo (optional - set path if you have one)
    'logo' => false,

    // Last updated text
    'last_updated' => 'Last updated: {date:F j, Y}',

    // Strategies for extracting info
    'strategies' => [
        'metadata' => [
            ...Defaults::METADATA_STRATEGIES,
        ],
        'headers' => [
            ...Defaults::HEADERS_STRATEGIES,
            Strategies\StaticData::withSettings(data: [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]),
        ],
        'urlParameters' => [
            ...Defaults::URL_PARAMETERS_STRATEGIES,
        ],
        'queryParameters' => [
            ...Defaults::QUERY_PARAMETERS_STRATEGIES,
        ],
        'bodyParameters' => [
            ...Defaults::BODY_PARAMETERS_STRATEGIES,
        ],
        'responses' => [
            ...Defaults::RESPONSES_STRATEGIES,
        ],
        'responseFields' => [
            ...Defaults::RESPONSE_FIELDS_STRATEGIES,
        ],
    ],

    // Database connections for response calls
    'database_connections_to_transact' => [config('database.default')],
];
