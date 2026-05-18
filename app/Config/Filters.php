<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
 
    public array $globals = [
        'before' => [
            // 'honeypot',

            // A unique token is generated per session; requests without
            // a matching token receive a 403 Forbidden response.
            'csrf',
        ],
        'after' => [
            'toolbar',   // Debug Toolbar (disabled automatically in production)

            // Works alongside esc() in views for defence-in-depth.
            'secureheaders',
        ],
    ];

    /**
     * Filters applied to specific HTTP methods.
     */
    public array $methods = [];
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
    ];

    /**
     * Filters applied to specific named routes.
     */
    public array $filters = [];
}
