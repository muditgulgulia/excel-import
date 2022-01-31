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
            "countries",
            "newsboard"
        ],
        'exclude' => [
            'migrations',
            'failed_jobs',
            'reset_tokens'
        ]
    ],

    'fields_to_be_excluded' => [
        'id', 'created_at', 'updated_at', 'deleted_at'
    ],

    'default_path' => 'assets/excel/global'
];
