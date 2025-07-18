<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        // 'applang' => [
        //     'driver' => 'applang',
        //     'root' => storage_path('app/applang'),
        //     'url' => env('APP_URL') . '/applang',
        //     'visibility' => 'public',
        // ],

        'attachment' => [
            'driver' => 'attachment',
            'root' => storage_path('app/attachment'),
            'url' => env('APP_URL') . '/attachment',
            'visibility' => 'public',
        ],

        'company' => [
            'driver' => 'company',
            'root' => storage_path('app/company'),
            'url' => env('APP_URL') . '/company',
            'visibility' => 'public',
        ],

        'exchange_permission' => [
            'driver' => 'exchange_permission',
            'root' => storage_path('app/exchange_permission'),
            'url' => env('APP_URL') . '/exchange_permission',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),

        // public_path('applang') => storage_path('app/applang'),
        public_path('attachment') => storage_path('app/attachment'),
        public_path('company') => storage_path('app/company'),
        public_path('exchange_permission') => storage_path('app/exchange_permission'),

    ],

];
