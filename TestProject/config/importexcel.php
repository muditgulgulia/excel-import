<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'tables' => [
        'import' => [
            "admin_roles",
            "brand_roles",
            "core_versions",
            "countries"
        ],
        'exclude' => [
            'migrations',
            'failed_jobs',
            'reset_tokens'
        ]
    ]
];
